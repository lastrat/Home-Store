@extends('layouts.app')

@section('title', 'Vérification OTP - Home Store')

@section('content')
    <section class="min-h-screen flex items-center justify-center bg-gray-50 py-12" style="margin-top: 50px;">
        <div class="max-w-md w-full mx-auto px-4">
            <div class="text-center mb-8">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-br from-gold-500 to-gold-400 flex items-center justify-center">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-black">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold mb-2">Vérification</h1>
                <p class="text-gray-500">Entrez le code reçu par SMS</p>
            </div>

            <div class="card p-8">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('otp.verify') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold mb-2">Numéro de téléphone</label>
                        <input type="tel" name="phone" class="form-input" placeholder="+237 xxx xxx xxx" required value="{{ Auth::user()->phone ?? '' }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">Code OTP</label>
                        <input type="text" name="code" class="form-input text-center text-2xl tracking-widest" placeholder="000000" maxlength="6" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-full">Vérifier</button>
                </form>

                <div class="mt-6 text-center">
                    <form method="POST" action="{{ route('otp.send') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-gold-600 font-semibold hover:underline">Renvoyer le code</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

