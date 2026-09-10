@extends('layouts.app')

@section('title', 'Notre Concept - Home Store | Chic Living')
@section('meta_description', 'Découvrez le concept unique de Home Store - Chic Living, une maison-boutique pas un magasin, dédiée à la mode et à la décoration intérieure à Abidjan. L\'accueil, le raffinement et la communauté sont nos valeurs.')
@section('meta_keywords', 'concept home store, maison boutique, mode décoration Abidjan, accueil personnalisé, raffinement, communauté, expérience shopping, boutique différent')
@section('canonical_url', route('concept'))
@section('og_title', 'Notre Concept - Home Store | Chic Living')
@section('og_description', 'Découvrez le concept unique de Home Store - Chic Living, une maison-boutique pas un magasin, dédiée à la mode et à la décoration intérieure.')
@section('og_image', asset('logo/logo100 hs.jpg'))
@section('twitter_title', 'Notre Concept - Home Store | Chic Living')
@section('twitter_description', 'Découvrez le concept unique de Home Store - Chic Living, une maison-boutique pas un magasin.')
@section('twitter_image', asset('logo/logo100 hs.jpg'))

@section('content')
    <section class="pt-28 pb-6 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <span class="text-brand-red font-semibold text-sm uppercase tracking-wider">Présentation du concept</span>
                <h1 class="text-4xl sm:text-5xl font-bold mt-2 mb-4 text-gray-900">Qui sommes-nous ?</h1>
                <div class="w-16 h-1 bg-brand-red mx-auto mb-6"></div>
                <p class="text-xl text-brand-dark font-semibold mb-4">Une maison-boutique, pas un magasin</p>
            </div>
        </div>
    </section>

    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <div class="bg-gray-50 rounded-3xl p-8 sm:p-12 mb-12">
                    <p class="text-lg text-gray-700 leading-relaxed mb-6">
                        <span class="font-bold text-gray-900">Home Store — Chic Living</span> est une maison-boutique dédiée à la mode et à la décoration intérieure, pensée pour des personnes qui veulent un style et un intérieur qui respirent le raffinement, sans le prix qui va avec.
                    </p>
                    <p class="text-lg text-gray-700 leading-relaxed mb-6">
                        Ici, pas de rayonnages froids ni de vendeurs pressés : vous entrez dans un vrai salon, où vêtements, chaussures, accessoires de mode et pièces de décoration sont mis en scène comme dans un appartement, pas comme dans un magasin. Chaque pièce est choisie pour sa qualité perçue haut de gamme et son prix pensé pour rester accessible.
                    </p>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        Que vous veniez compléter votre dressing ou repenser votre intérieur, l'équipe vous accompagne dans une expérience fluide — de la découverte digitale sur tablette à l'essayage en cabine, jusqu'au conseil personnalisé qui raconte l'histoire de chaque produit.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-brand-dark text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-gold-400 font-semibold text-sm uppercase tracking-wider">Nos Activités</span>
                <h2 class="text-3xl sm:text-4xl font-bold mt-2 mb-4">Ce que nous faisons</h2>
                <div class="w-16 h-1 bg-brand-red mx-auto"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="group relative overflow-hidden rounded-3xl bg-white/5 border border-white/10 p-8 sm:p-10 hover:border-gold-500/30 transition-all duration-500">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-brand-red/10 rounded-full blur-3xl group-hover:bg-brand-red/20 transition-all"></div>
                    <div class="relative">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-gold-500 to-gold-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-black">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                        </div>
                        <span class="text-gold-400 font-bold text-sm mb-2 block">01</span>
                        <h3 class="text-2xl font-bold mb-3">Vente en boutique</h3>
                        <p class="text-gray-300 leading-relaxed">Accueil personnalisé dans notre boutique, où vous pouvez découvrir et essayer nos produits avec les conseils de notre équipe.</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-3xl bg-white/5 border border-white/10 p-8 sm:p-10 hover:border-gold-500/30 transition-all duration-500">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gold-500/10 rounded-full blur-3xl group-hover:bg-gold-500/20 transition-all"></div>
                    <div class="relative">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-gold-500 to-gold-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-black">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                            </svg>
                        </div>
                        <span class="text-gold-400 font-bold text-sm mb-2 block">02</span>
                        <h3 class="text-2xl font-bold mb-3">Vente en ligne</h3>
                        <p class="text-gray-300 leading-relaxed">Commandez à tout moment depuis notre boutique en ligne, avec un catalogue mis à jour. Récupérez vos articles en boutique ou faites-vous livrer.</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-3xl bg-white/5 border border-white/10 p-8 sm:p-10 hover:border-gold-500/30 transition-all duration-500">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-brand-red/10 rounded-full blur-3xl group-hover:bg-brand-red/20 transition-all"></div>
                    <div class="relative">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-gold-500 to-gold-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-black">
                                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                <line x1="7" y1="7" x2="7.01" y2="7"></line>
                            </svg>
                        </div>
                        <span class="text-gold-400 font-bold text-sm mb-2 block">03</span>
                        <h3 class="text-2xl font-bold mb-3">Vente à domicile</h3>
                        <p class="text-gray-300 leading-relaxed">Nous nous déplaçons chez vous pour vous présenter nos produits et vous accompagner dans votre choix, en toute simplicité.</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-3xl bg-white/5 border border-white/10 p-8 sm:p-10 hover:border-gold-500/30 transition-all duration-500">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gold-500/10 rounded-full blur-3xl group-hover:bg-gold-500/20 transition-all"></div>
                    <div class="relative">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-gold-500 to-gold-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-black">
                                <rect x="1" y="3" width="15" height="13"></rect>
                                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                <circle cx="18.5" cy="18.5" r="2.5"></circle>
                            </svg>
                        </div>
                        <span class="text-gold-400 font-bold text-sm mb-2 block">04</span>
                        <h3 class="text-2xl font-bold mb-3">Livraison d'article</h3>
                        <p class="text-gray-300 leading-relaxed">Une fois votre commande passée, nous assurons la livraison rapide et soignée de vos articles, où que vous soyez.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-brand-red font-semibold text-sm uppercase tracking-wider">Nos Valeurs</span>
                <h2 class="text-3xl sm:text-4xl font-bold mt-2 mb-4 text-gray-900">Ce qui nous anime</h2>
                <div class="w-16 h-1 bg-brand-red mx-auto"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="card p-8 text-center group hover:border-brand-red/30 transition-all duration-300">
                    <div class="w-16 h-16 mx-auto mb-6 rounded-full bg-brand-red/10 flex items-center justify-center group-hover:bg-brand-red/20 transition-colors">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-brand-red">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">1. L'Accueil</h3>
                    <p class="text-gray-600 leading-relaxed">Chez nous, chaque porte qui s'ouvre est celle d'une maison, jamais celle d'un magasin. On reçoit, on ne vend pas.</p>
                </div>
                <div class="card p-8 text-center group hover:border-brand-red/30 transition-all duration-300">
                    <div class="w-16 h-16 mx-auto mb-6 rounded-full bg-gold-100 flex items-center justify-center group-hover:bg-gold-200 transition-colors">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gold-600">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">2. Le Raffinement</h3>
                    <p class="text-gray-600 leading-relaxed">Chaque pièce est choisie avec soin, comme on choisirait un objet pour son propre salon — pour que le chic se vive, sans jamais se compter.</p>
                </div>
                <div class="card p-8 text-center group hover:border-brand-red/30 transition-all duration-300">
                    <div class="w-16 h-16 mx-auto mb-6 rounded-full bg-brand-red/10 flex items-center justify-center group-hover:bg-brand-red/20 transition-colors">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-brand-red">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">3. La Communauté</h3>
                    <p class="text-gray-600 leading-relaxed">On ne fait pas que des ventes, on fait vivre des moments. Ici, les clients deviennent des habitués, et les habitués deviennent une famille.</p>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.card, .group').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                observer.observe(el);
            });
        });
    </script>
@endpush
