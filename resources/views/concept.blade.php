@extends('layouts.app')

@section('title', 'Notre Concept - Home Store')

@section('content')
    <section class="pt-32 pb-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <span class="text-gold-600 font-semibold text-sm uppercase tracking-wider">Notre Histoire</span>
                <h1 class="text-4xl sm:text-5xl font-bold mt-2 mb-6">L'Art du Chic <span class="text-gradient">Intemporel</span></h1>
                <p class="text-lg text-gray-500 leading-relaxed">Né d'une passion pour le beau et le bien, Home Store Chic Living est né pour réinventer l'expérience shopping en Afrique.</p>
            </div>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800&q=80" alt="Notre showroom" class="rounded-2xl shadow-2xl w-full object-cover h-[400px]">
                </div>
                <div>
                    <h2 class="text-3xl font-bold mb-6">Une Expérience <span class="text-gradient">Unique</span></h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">Notre showroom est un écrin de douceur et d'élégance, où chaque pièce est choisie avec soin pour vous offrir le meilleur du chic accessible.</p>
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-gold-100 flex items-center justify-center flex-shrink-0">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gold-600">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Sélection Premium</h4>
                                <p class="text-sm text-gray-500">Chaque produit est rigoureusement sélectionné pour sa qualité et son style.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-gold-100 flex items-center justify-center flex-shrink-0">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gold-600">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Service Personnalisé</h4>
                                <p class="text-sm text-gray-500">Conseil personnalisé pour trouver la pièce parfaite qui vous ressemble.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-gold-100 flex items-center justify-center flex-shrink-0">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gold-600">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Engagement Qualité</h4>
                                <p class="text-sm text-gray-500">Nous garantissons la qualité et l'authenticité de chaque article.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Nos Valeurs</h2>
                <p class="text-gray-500 max-w-xl mx-auto">Le chic n'est pas un luxe, c'est un art de vivre.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="card p-8 text-center">
                    <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-gold-500 to-gold-400 flex items-center justify-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-black">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Excellence</h3>
                    <p class="text-gray-500 text-sm">Nous ne compromettons jamais sur la qualité de nos produits et services.</p>
                </div>
                <div class="card p-8 text-center">
                    <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-gold-500 to-gold-400 flex items-center justify-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-black">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Passion</h3>
                    <p class="text-gray-500 text-sm">Chaque pièce est choisie avec passion et un souci du détail obsessionnel.</p>
                </div>
                <div class="card p-8 text-center">
                    <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-gold-500 to-gold-400 flex items-center justify-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-black">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="2" y1="12" x2="22" y2="12"></line>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Ouverture</h3>
                    <p class="text-gray-500 text-sm">Nous célébrons la diversité des styles et des personnalités.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
