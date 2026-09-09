@extends('layouts.app')

@section('title', 'Inscription - Home Store')

@section('content')
    <section class="min-h-screen flex items-center justify-center bg-gray-50 py-12" style="margin-top: 100px;">
        <div class="max-w-lg w-full mx-auto px-4">
            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-gold-500 to-gold-400 flex items-center justify-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-black">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </div>
                </a>
                <h1 class="text-3xl font-bold mb-2">Créer un compte</h1>
                <p class="text-gray-500">Rejoignez le club privé Home Store</p>
            </div>

            <div class="card p-8">
                @if($errors->any())
                    <div class="alert alert-error">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold mb-2">Nom complet</label>
                            <input type="text" name="name" class="form-input" placeholder="Jean Dupont" required value="{{ old('name') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Date de naissance</label>
                            <input type="date" name="birthdate" class="form-input" required value="{{ old('birthdate') }}">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">Email</label>
                        <input type="email" name="email" class="form-input" placeholder="votre@email.com" required value="{{ old('email') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">Numéro de téléphone</label>
                        <input type="tel" name="phone" class="form-input" placeholder="+225 01 00 00 00 00" required value="{{ old('phone') }}">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold mb-2">Profession</label>
                            <select name="profession" class="form-input" required>
                                <option value="">Sélectionner...</option>
                                <option value="Fonctionnaire" {{ old('profession') == 'Fonctionnaire' ? 'selected' : '' }}>Fonctionnaire</option>
                                <option value="Entrepreneur" {{ old('profession') == 'Entrepreneur' ? 'selected' : '' }}>Entrepreneur</option>
                                <option value="Étudiant" {{ old('profession') == 'Étudiant' ? 'selected' : '' }}>Étudiant</option>
                                <option value="Autre" {{ old('profession') == 'Autre' ? 'selected' : '' }}>Autre</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Quartier</label>
                            <select name="neighborhood_id" class="form-input">
                                <option value="">Sélectionner...</option>
                                @foreach($neighborhoods as $neighborhood)
                                    <option value="{{ $neighborhood->id }}" {{ old('neighborhood_id') == $neighborhood->id ? 'selected' : '' }}>{{ $neighborhood->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold mb-2">Mot de passe</label>
                            <input type="password" name="password" class="form-input" placeholder="••••••••" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Confirmer le mot de passe</label>
                            <input type="password" name="password_confirmation" class="form-input" placeholder="••••••••" required>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <input type="checkbox" name="terms" id="terms" class="mt-1 w-4 h-4 rounded border-gray-300 text-gold-600 focus:ring-gold-500" required>
                        <label for="terms" class="text-sm text-gray-600">J'accepte les conditions générales et la politique de confidentialité.</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-full">Créer mon compte</button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-500">Déjà un compte ? <a href="{{ route('login') }}" class="text-gold-600 font-semibold hover:underline">Se connecter</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection

