@extends('layouts.app')

@section('title', 'Nos Activités - Home Store | Vente, Livraison et Service à Domicile')
@section('meta_description', 'Explorez les activités de Home Store - Chic Living : vente en boutique, vente en ligne, vente à domicile et livraison d\'articles à Abidjan. Plusieurs façons de découvrir et d\'acquérir vos coups de cœur.')
@section('meta_keywords', 'activités home store, vente boutique Abidjan, vente en ligne, vente à domicile, livraison articles, service client, shopping Abidjan, mode décoration')
@section('canonical_url', route('activities'))
@section('og_title', 'Nos Activités - Home Store | Vente, Livraison et Service à Domicile')
@section('og_description', 'Explorez les activités de Home Store - Chic Living : vente en boutique, vente en ligne, vente à domicile et livraison d\'articles à Abidjan.')
@section('og_image', asset('logo/logo100 hs.jpg'))
@section('twitter_title', 'Nos Activités - Home Store | Vente, Livraison et Service à Domicile')
@section('twitter_description', 'Explorez les activités de Home Store - Chic Living : vente en boutique, vente en ligne, vente à domicile et livraison d\'articles à Abidjan.')
@section('twitter_image', asset('logo/logo100 hs.jpg'))

@section('content')
     <section class="pt-32 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <!-- <span class="text-gold-600 font-semibold text-sm uppercase tracking-wider">Comment nous joindre</span> -->
                <h1 class="text-4xl sm:text-5xl font-bold mt-2 mb-6 text-gradient">Nos <span class="">Activités</span></h1>
                <p class="text-lg text-gray-500 leading-relaxed">Plusieurs façons de découvrir et d'acquérir vos coups de cœur Home Store.</p>
            </div>
        </div>
    </section>

    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="group relative overflow-hidden rounded-3xl bg-gray-50 border border-gray-100 hover:border-gold-300 transition-all duration-500">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="{{ asset('images/boutique.jpg') }}" alt="Vente en boutique" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <div class="p-8">
                        <span class="text-brand-red font-bold text-sm mb-2 block">01</span>
                        <h3 class="text-2xl font-bold mb-3 text-gray-900">Vente en boutique</h3>
                        <p class="text-gray-600 leading-relaxed">Accueil personnalisé dans notre boutique, où vous pouvez découvrir et essayer nos produits avec les conseils de notre équipe.</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-3xl bg-gray-50 border border-gray-100 hover:border-gold-300 transition-all duration-500">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="{{ asset('images/enligne.jpg') }}" alt="Vente en ligne" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <div class="p-8">
                        <span class="text-brand-red font-bold text-sm mb-2 block">02</span>
                        <h3 class="text-2xl font-bold mb-3 text-gray-900">Vente en ligne</h3>
                        <p class="text-gray-600 leading-relaxed">Commandez à tout moment depuis notre boutique en ligne, avec un catalogue mis à jour. Récupérez vos articles en boutique ou faites-vous livrer.</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-3xl bg-gray-50 border border-gray-100 hover:border-gold-300 transition-all duration-500">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="{{ asset('images/domicile.jpg') }}" alt="Vente à domicile" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <div class="p-8">
                        <span class="text-brand-red font-bold text-sm mb-2 block">03</span>
                        <h3 class="text-2xl font-bold mb-3 text-gray-900">Vente à domicile</h3>
                        <p class="text-gray-600 leading-relaxed">Nous nous déplaçons chez vous pour vous présenter nos produits et vous accompagner dans votre choix, en toute simplicité.</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-3xl bg-gray-50 border border-gray-100 hover:border-gold-300 transition-all duration-500">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="{{ asset('images/livraison.jpg') }}" alt="Livraison d'article" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <div class="p-8">
                        <span class="text-brand-red font-bold text-sm mb-2 block">04</span>
                        <h3 class="text-2xl font-bold mb-3 text-gray-900">Livraison d'article</h3>
                        <p class="text-gray-600 leading-relaxed">Une fois votre commande passée, nous assurons la livraison rapide et soignée de vos articles, où que vous soyez.</p>
                    </div>
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
