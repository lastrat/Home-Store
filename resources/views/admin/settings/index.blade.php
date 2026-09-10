@extends('layouts.app')

@section('title', 'Paramètres - Admin')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold">Paramètres du Site</h1>
            <p class="text-gray-500">Configuration générale et contact</p>
            <div class="w-12 h-1 bg-brand-red mt-3"></div>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="card p-8">
                @if(session('success'))
                    <div class="alert alert-success mb-6">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="border-b border-gray-200 pb-6 mb-6">
                        <h2 class="text-xl font-bold mb-1">Contact</h2>
                        <p class="text-sm text-gray-500">Ces informations seront utilisées pour recevoir les messages du formulaire de contact.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2">Email de réception <span class="text-brand-red">*</span></label>
                        <input type="email" name="contact_email" class="form-input" required value="{{ old('contact_email', App\Models\SiteSetting::get('contact_email', config('mail.from.address'))) }}" placeholder="contact@homestore.ci">
                        @error('contact_email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2">Téléphone</label>
                        <input type="text" name="contact_phone" class="form-input" value="{{ old('contact_phone', App\Models\SiteSetting::get('contact_phone')) }}" placeholder="+237 6 99 82 29 01">
                        @error('contact_phone')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2">Adresse</label>
                        <input type="text" name="contact_address" class="form-input" value="{{ old('contact_address', App\Models\SiteSetting::get('contact_address')) }}" placeholder="Akwa Nord, Douala, Cameroun">
                        @error('contact_address')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="border-b border-gray-200 pb-6 mb-6">
                        <h2 class="text-xl font-bold mb-1">Général</h2>
                        <p class="text-sm text-gray-500">Informations générales du site.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2">Nom du site</label>
                        <input type="text" name="site_name" class="form-input" value="{{ old('site_name', App\Models\SiteSetting::get('site_name', config('app.name'))) }}" placeholder="Home Store - Chic Living">
                        @error('site_name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2">Description du site</label>
                        <textarea name="site_description" rows="3" class="form-input" placeholder="Description courte du site">{{ old('site_description', App\Models\SiteSetting::get('site_description')) }}</textarea>
                        @error('site_description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button type="submit" class="btn btn-primary">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            Enregistrer
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
