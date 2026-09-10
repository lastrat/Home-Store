@extends('layouts.app')

@section('title', 'Contactez-nous - Home Store')

@section('content')
    <section class="pt-32 pb-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <span class="text-brand-red font-semibold text-sm uppercase tracking-wider">Contactez-nous</span>
                <h1 class="text-4xl sm:text-5xl font-bold mt-2 mb-4 text-gray-900 text-gradient">Restons en <span class="">Contact</span></h1>
                <div class="w-16 h-1 bg-brand-red mx-auto mb-6"></div>
                <p class="text-xl text-gray-600 leading-relaxed">Une question, une demande spécifique ou simplement envie de dire bonjour ? Nous sommes à votre écoute.</p>
            </div>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="alert alert-success max-w-3xl mx-auto mb-8">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error max-w-3xl mx-auto mb-8">{{ session('error') }}</div>
            @endif
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <form class="card p-8 space-y-6" method="POST" action="{{ route('contact.send') }}">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold mb-2">Nom complet <span class="text-brand-red">*</span></label>
                            <input type="text" name="name" class="form-input" placeholder="Votre nom" required value="{{ old('name') }}">
                            @error('name')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Email <span class="text-brand-red">*</span></label>
                            <input type="email" name="email" class="form-input" placeholder="votre@email.com" required value="{{ old('email') }}">
                            @error('email')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Sujet <span class="text-brand-red">*</span></label>
                            <select name="subject" class="form-input" required>
                                <option value="">Sélectionner...</option>
                                <option value="Demande d'information" {{ old('subject') == 'Demande d\'information' ? 'selected' : '' }}>Demande d'information</option>
                                <option value="Commande" {{ old('subject') == 'Commande' ? 'selected' : '' }}>Commande</option>
                                <option value="Service client" {{ old('subject') == 'Service client' ? 'selected' : '' }}>Service client</option>
                                <option value="Autre" {{ old('subject') == 'Autre' ? 'selected' : '' }}>Autre</option>
                            </select>
                            @error('subject')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Message <span class="text-brand-red">*</span></label>
                            <textarea name="message" rows="5" class="form-input" placeholder="Votre message..." required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-full">Envoyer le message</button>
                    </form>
                </div>
                <div class="space-y-6">
                    <div class="card p-8">
                        <h3 class="text-xl font-bold mb-6">Nos Coordonnées</h3>
                        <div class="space-y-4">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-gold-100 flex items-center justify-center flex-shrink-0">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gold-600">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-sm">Adresse</h4>
                                    <p class="text-gray-500 text-sm">{{ \App\Models\SiteSetting::get('contact_address', 'Akwa Nord, Douala, Cameroun') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-gold-100 flex items-center justify-center flex-shrink-0">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gold-600">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-sm">Téléphone</h4>
                                    <a href="tel:+237699822901" class="text-brand-red hover:underline text-sm">{{ \App\Models\SiteSetting::get('contact_phone', '+237 6 99 82 29 01') }}</a>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-gold-100 flex items-center justify-center flex-shrink-0">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gold-600">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-sm">Email</h4>
                                    <a href="mailto:{{ \App\Models\SiteSetting::get('contact_email', 'contact@homestore.ci') }}" class="text-brand-red hover:underline text-sm">{{ \App\Models\SiteSetting::get('contact_email', 'contact@homestore.ci') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

