@extends('layouts.app')

@section('title', 'Nos Activités - Home Store')

@section('content')
    <section class="pt-32 pb-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <span class="text-gold-600 font-semibold text-sm uppercase tracking-wider">Comment nous joindre</span>
                <h1 class="text-4xl sm:text-5xl font-bold mt-2 mb-6">Nos <span class="text-gradient">Activités</span></h1>
                <p class="text-lg text-gray-500 leading-relaxed">Plusieurs façons de découvrir et d'acquérir vos coups de cœur Home Store.</p>
            </div>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="card p-8 hover:border-gold-300 border-2 border-transparent">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-gold-500 to-gold-400 flex items-center justify-center mb-6">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-black">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                            <line x1="8" y1="21" x2="16" y2="21"></line>
                            <line x1="12" y1="17" x2="12" y2="21"></line>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Vente en Ligne</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Parcourez notre catalogue privé, composez votre panier et recevez votre reçu de commande.</p>
                </div>
                <div class="card p-8 hover:border-gold-300 border-2 border-transparent">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-gold-500 to-gold-400 flex items-center justify-center mb-6">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-black">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Vente en Boutique</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Venez découvrir nos collections dans notre showroom physique et bénéficiez de nos conseils.</p>
                </div>
                <div class="card p-8 hover:border-gold-300 border-2 border-transparent">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-gold-500 to-gold-400 flex items-center justify-center mb-6">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-black">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Vente à Domicile</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Notre équipe se déplace chez vous pour une présentation personnalisée de nos collections.</p>
                </div>
                <div class="card p-8 hover:border-gold-300 border-2 border-transparent">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-gold-500 to-gold-400 flex items-center justify-center mb-6">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-black">
                            <rect x="1" y="3" width="15" height="13"></rect>
                            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                            <circle cx="5.5" cy="18.5" r="2.5"></circle>
                            <circle cx="18.5" cy="18.5" r="2.5"></circle>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Livraison</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Nous livrons vos commandes à domicile avec soin et rapidité.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-brand-dark to-gray-800 p-12 lg:p-16">
                <div class="relative z-10 max-w-2xl">
                    <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Prêt à découvrir nos collections ?</h2>
                    <p class="text-gray-300 mb-8">Inscrivez-vous pour accéder à notre catalogue privé et profitez d'une expérience shopping unique.</p>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Créer mon compte</a>
                </div>
            </div>
        </div>
    </section>
@endsection

