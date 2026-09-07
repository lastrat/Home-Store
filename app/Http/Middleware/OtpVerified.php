<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OtpVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || is_null($request->user()->phone_verified_at)) {
            return redirect()->route('otp.verify.form')->with('error', 'Veuillez vérifier votre numéro de téléphone pour accéder au catalogue.');
        }

        return $next($request);
    }
}
