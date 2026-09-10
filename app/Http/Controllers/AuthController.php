<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Neighborhood;
use App\Models\User;
use EnvoiSMS\Laravel\Facades\EnvoiSMS;
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

        $otpResponse = EnvoiSMS::sendOtp([
            'to' => $request->phone,
            'brand' => 'Home Store',
        ]);

        session([
            'otp_session_id' => $otpResponse['session_id'],
            'otp_phone' => $request->phone,
        ]);

        return redirect()->route('otp.verify.form', ['phone' => $request->phone])
            ->with('success', 'Compte créé. Un code de vérification a été envoyé par SMS.');
    }

    public function showOtpVerify(Request $request)
    {
        $phone = $request->query('phone', session('phone', ''));
        return view('auth.otp-verify', compact('phone'));
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
        ]);

        $response = EnvoiSMS::sendOtp([
            'to' => $request->phone,
            'brand' => 'Home Store',
        ]);

        session([
            'otp_session_id' => $response['session_id'],
            'otp_phone' => $request->phone,
        ]);

        return back()->with('success', 'Code OTP envoyé par SMS.');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
            'code' => 'required|string|size:6',
        ]);

        $sessionId = session('otp_session_id');
        $phone = session('otp_phone');

        if (!$sessionId || !$phone || $phone !== $request->phone) {
            return back()->withErrors(['code' => 'Session OTP invalide. Veuillez renvoyer un code.']);
        }

        $result = EnvoiSMS::checkOtp(
            sessionId: $sessionId,
            code: $request->code
        );

        if (!($result['verified'] ?? false)) {
            return back()->withErrors(['code' => 'Code invalide ou expiré.']);
        }

        $user = User::where('phone', $request->phone)->first();
        if ($user) {
            $user->update(['phone_verified_at' => now()]);
            Auth::login($user);
        }

        session()->forget(['otp_session_id', 'otp_phone']);

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
