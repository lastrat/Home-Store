@extends('layouts.app')

@section('title', 'Home Store - Chic Living')

@section('content')
    <section class="hero" style="margin-top: 75px;">
        <div class="hero-bg" style="background-image: url('https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=1600&q=80');"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="max-w-2xl">
                <!-- <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gold-500/10 border border-gold-500/20 mb-6 fade-in">
                    <span class="w-2 h-2 rounded-full bg-gold-400 animate-pulse"></span>
                    <span class="text-gold-400 text-sm font-medium">Collection Exclusive 2026</span>
                </div> -->
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-white mb-6 fade-in" style="animation-delay: 0.1s">
                    L'Élégance <span class="text-gradient">Chic</span> <br>chez Vous
                </h1>
                <p class="text-lg text-gray-300 mb-8 max-w-lg fade-in" style="animation-delay: 0.2s">
                    Découvrez notre collection exclusive de mode et décoration. Un style raffiné pour une vie chic.
                </p>
                <div class="flex flex-wrap gap-4 fade-in" style="animation-delay: 0.3s">
                    <a href="{{ auth()->check() ? route('catalog.index') : route('register') }}" class="btn btn-primary btn-lg">
                        Découvrir le Catalogue
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                    <a href="{{ route('concept') }}" class="btn btn-outline btn-lg text-white border-white/30 hover:bg-white hover:text-black">
                        Notre Concept
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-gold-600 font-semibold text-sm uppercase tracking-wider">Catalogue Privé</span>
                <h2 class="text-3xl sm:text-4xl font-bold mt-2 mb-4">Nos Incontournables</h2>
                <p class="text-gray-500 max-w-xl mx-auto">Une sélection raffinée de nos pièces favorites, disponibles exclusivement pour nos clients inscrits.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($featuredProducts as $product)
                    @include('components.product-card', ['product' => $product])
                @empty
                    <div class="col-span-full text-center py-16">
                        <p class="text-gray-400">Aucun produit en vedette pour le moment.</p>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-12">
                <a href="{{ auth()->check() ? route('catalog.index') : route('register') }}" class="btn btn-primary btn-lg">
                    Voir tout le catalogue
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="text-gold-600 font-semibold text-sm uppercase tracking-wider">Nouveautés Mode</span>
                    <h2 class="text-3xl sm:text-4xl font-bold mt-2 mb-6">Dernières Tendances</h2>
                    <p class="text-gray-500 mb-8">Les pièces qui définissent la saison. Des coupes modernes, des matières nobles, un style incomparable.</p>
                    <div class="grid grid-cols-2 gap-4">
                        @forelse($newProducts as $product)
                            @include('components.product-card', ['product' => $product])
                        @empty
                            <p class="text-gray-400 col-span-2">Aucun produit pour le moment.</p>
                        @endforelse
                    </div>
                </div>
                <div>
                    <span class="text-gold-600 font-semibold text-sm uppercase tracking-wider">Décoration</span>
                    <h2 class="text-3xl sm:text-4xl font-bold mt-2 mb-6">Ambiance & Design</h2>
                    <p class="text-gray-500 mb-8">Transformez votre intérieur avec nos pièces de décoration soigneusement sélectionnées pour un chic authentique.</p>
                    <div class="grid grid-cols-2 gap-4">
                        @forelse($decoProducts as $product)
                            @include('components.product-card', ['product' => $product])
                        @empty
                            <p class="text-gray-400 col-span-2">Aucun produit pour le moment.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-brand-dark text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-8">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-gold-500 to-gold-400 flex items-center justify-center">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-black">
                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                            <line x1="7" y1="7" x2="7.01" y2="7"></line>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Mode & Décoration</h3>
                    <p class="text-gray-400 text-sm">Collections exclusives pour homme, femme et maison.</p>
                </div>
                <div class="text-center p-8">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-gold-500 to-gold-400 flex items-center justify-center">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-black">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Click & Collect</h3>
                    <p class="text-gray-400 text-sm">Commandez en ligne et récupérez en boutique sous 48h.</p>
                </div>
                <div class="text-center p-8">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-gold-500 to-gold-400 flex items-center justify-center">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-black">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Qualité Garantie</h3>
                    <p class="text-gray-400 text-sm">Des produits soigneusement sélectionnés pour leur qualité.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-brand-dark to-gray-800 p-12 lg:p-16">
                <div class="relative z-10 max-w-xl">
                    <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Rejoignez le Club Privé</h2>
                    <p class="text-gray-300 mb-8">Accédez à notre catalogue exclusif, recevez nos offres privilégiées et vivez l'expérience Home Store.</p>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                        Créer mon compte
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
                <div class="absolute right-0 top-0 w-1/2 h-full opacity-20">
                    <svg viewBox="0 0 200 200" class="w-full h-full text-gold-400">
                        <circle cx="100" cy="100" r="80" fill="none" stroke="currentColor" stroke-width="0.5"/>
                        <circle cx="100" cy="100" r="60" fill="none" stroke="currentColor" stroke-width="0.5"/>
                        <circle cx="100" cy="100" r="40" fill="none" stroke="currentColor" stroke-width="0.5"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>
@endsection
