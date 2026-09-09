@extends('layouts.app')

@section('title', 'Nos Activités - Home Store')

@section('content')
    <section class="pt-32 pb-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <span class="text-brand-red font-semibold text-sm uppercase tracking-wider">Nos Activités</span>
                <h1 class="text-4xl sm:text-5xl font-bold mt-2 mb-4 text-gray-900">Ce que nous faisons</h1>
                <div class="w-16 h-1 bg-brand-red mx-auto mb-6"></div>
                <p class="text-xl text-gray-600 leading-relaxed">Plusieurs façons de découvrir et d'acquérir vos coups de cœur Home Store.</p>
            </div>
        </div>
    </section>

    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="group relative overflow-hidden rounded-3xl bg-gray-50 border border-gray-100 hover:border-gold-300 transition-all duration-500">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&q=80" alt="Vente en boutique" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <div class="p-8">
                        <span class="text-brand-red font-bold text-sm mb-2 block">01</span>
                        <h3 class="text-2xl font-bold mb-3 text-gray-900">Vente en boutique</h3>
                        <p class="text-gray-600 leading-relaxed">Accueil personnalisé dans notre boutique, où vous pouvez découvrir et essayer nos produits avec les conseils de notre équipe.</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-3xl bg-gray-50 border border-gray-100 hover:border-gold-300 transition-all duration-500">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&q=80" alt="Vente en ligne" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <div class="p-8">
                        <span class="text-brand-red font-bold text-sm mb-2 block">02</span>
                        <h3 class="text-2xl font-bold mb-3 text-gray-900">Vente en ligne</h3>
                        <p class="text-gray-600 leading-relaxed">Commandez à tout moment depuis notre boutique en ligne, avec un catalogue mis à jour. Récupérez vos articles en boutique ou faites-vous livrer.</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-3xl bg-gray-50 border border-gray-100 hover:border-gold-300 transition-all duration-500">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&q=80" alt="Vente à domicile" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <div class="p-8">
                        <span class="text-brand-red font-bold text-sm mb-2 block">03</span>
                        <h3 class="text-2xl font-bold mb-3 text-gray-900">Vente à domicile</h3>
                        <p class="text-gray-600 leading-relaxed">Nous nous déplaçons chez vous pour vous présenter nos produits et vous accompagner dans votre choix, en toute simplicité.</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-3xl bg-gray-50 border border-gray-100 hover:border-gold-300 transition-all duration-500">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&q=80" alt="Livraison d'article" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
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
@endsection
