<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Neighborhood;
use App\Models\OtpCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('phone', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('catalog.index'));
        }

        return back()->withErrors([
            'phone' => 'Numéro de téléphone ou mot de passe incorrect.',
        ]);
    }

    public function showRegister()
    {
        $cities = City::orderBy('order')->get();
        $neighborhoods = Neighborhood::orderBy('name')->get();
        return view('auth.register', compact('cities', 'neighborhoods'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date|before:-13 years',
            'phone' => 'required|string|max:20|unique:users,phone',
            'email' => 'required|string|email|max:255|unique:users,email',
            'profession' => 'required|string|max:100',
            'city_id' => 'nullable|exists:cities,id',
            'neighborhood_id' => 'nullable|exists:neighborhoods,id',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required|accepted',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'birthdate' => $request->birthdate,
            'profession' => $request->profession,
            'city_id' => $request->city_id,
            'neighborhood_id' => $request->neighborhood_id,
        ]);

        Auth::login($user);

        return redirect()->route('otp.verify.form')->with('success', 'Compte créé. Veuillez vérifier votre numéro de téléphone.');
    }

    public function showOtpVerify()
    {
        return view('auth.otp-verify');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
        ]);

        $code = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        OtpCode::create([
            'phone' => $request->phone,
            'code' => $code,
            'expires_at' => now()->addMinutes(10),
        ]);

        // Mock: log the code. Replace with Twilio in production.
        logger()->info("OTP Code for {$request->phone}: {$code}");

        return back()->with('success', "Code OTP envoyé (mock: {$code}).");
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
            'code' => 'required|string|size:4',
        ]);

        $otp = OtpCode::where('phone', $request->phone)
            ->where('code', $request->code)
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (!$otp) {
            return back()->withErrors(['code' => 'Code invalide ou expiré.']);
        }

        $user = User::where('phone', $request->phone)->first();
        if ($user) {
            $user->update(['phone_verified_at' => now()]);
            Auth::login($user);
        }

        $otp->delete();

        return redirect()->route('catalog.index')->with('success', 'Téléphone vérifié avec succès!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
