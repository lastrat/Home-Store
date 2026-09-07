@extends('layouts.app')

@section('title', 'Connexion - Home Store')

@section('content')
    <section class="min-h-screen flex items-center justify-center bg-gray-50 py-12">
        <div class="max-w-md w-full mx-auto px-4">
            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-gold-500 to-gold-700 flex items-center justify-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-black">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </div>
                </a>
                <h1 class="text-3xl font-bold mb-2">Connexion</h1>
                <p class="text-gray-500">Accédez à votre espace privé</p>
            </div>

            <div class="card p-8">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold mb-2">Numéro de téléphone</label>
                        <input type="text" name="phone" class="form-input" placeholder="+225 01 00 00 00 00" required autofocus value="{{ old('phone') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">Mot de passe</label>
                        <input type="password" name="password" class="form-input" placeholder="••••••••" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-full">Se connecter</button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-500">Pas encore de compte ? <a href="{{ route('register') }}" class="text-gold-600 font-semibold hover:underline">S'inscrire</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection
