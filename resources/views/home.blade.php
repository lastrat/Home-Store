@extends('layouts.app')

@section('title', 'Home Store - Chic Living | Mode et Décoration Haut de Gamme')
@section('meta_description', 'Découvrez Home Store - Chic Living, votre maison-boutique de mode et décoration à Abidjan. Vente en boutique, en ligne et à domicile. Collections exclusives de vêtements, accessoires et décoration intérieure.')
@section('meta_keywords', 'home store, chic living, mode Abidjan, décoration intérieure, boutique mode, vêtements homme femme, accessoires mode, design intérieur, luxe accessible, Abidjan shopping')
@section('canonical_url', route('home'))
@section('og_title', 'Home Store - Chic Living | Mode et Décoration Haut de Gamme')
@section('og_description', 'Découvrez Home Store - Chic Living, votre maison-boutique de mode et décoration à Abidjan. Vente en boutique, en ligne et à domicile.')
@section('og_image', asset('logo/logo100 hs.jpg'))
@section('twitter_title', 'Home Store - Chic Living | Mode et Décoration Haut de Gamme')
@section('twitter_description', 'Découvrez Home Store - Chic Living, votre maison-boutique de mode et décoration à Abidjan.')
@section('twitter_image', asset('logo/logo100 hs.jpg'))
@section('json_ld', json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Store',
    'name' => 'Home Store - Chic Living',
    'description' => 'Maison-boutique dédiée à la mode et à la décoration intérieure',
    'url' => config('app.url'),
    'logo' => asset('logo/logo100 hs.jpg'),
    'image' => asset('logo/logo100 hs.jpg'),
    'telephone' => '',
    'address' => [
        '@type' => 'PostalAddress',
        'addressLocality' => 'Abidjan',
        'addressCountry' => 'CI'
    ],
    'openingHoursSpecification' => [
        '@type' => 'OpeningHoursSpecification',
        'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        'opens' => '09:00',
        'closes' => '19:00'
    ],
    'sameAs' => []
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))

@section('content')
    <!-- Slider Section Hero  -->
    @if($heroSlides->isNotEmpty())
        <section class="hero has-swiper" style="margin-top: 75px;">
            <div class="swiper hero-swiper">
                <div class="swiper-wrapper">
                    @foreach($heroSlides as $slide)
                        <div class="swiper-slide relative">
                            <div class="hero-bg absolute inset-0" style="background-image: url('{{ asset('storage/' . $slide->background_image) }}');"></div>
                            <div class="absolute inset-0 bg-gradient-to-b from-black/70  to-black/70 z-[1]"></div>
                            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full h-full flex items-center">
                                <div class="max-w-2xl py-8 sm:py-20">
                                    @if($slide->badge_text)
                                        <span class="inline-block px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-brand-red/90 text-white text-xs sm:text-sm font-semibold mb-4 sm:mb-6 fade-in">{{ $slide->badge_text }}</span>
                                    @endif
                                    <h1 class="text-3xl sm:text-5xl lg:text-7xl font-bold text-white mb-2 fade-in" style="animation-delay: 0.1s">
                                        {{ $slide->title }}
                                    </h1>
                                    @if($slide->subtitle)
                                        <div class="w-12 h-1 bg-brand-red mb-4 sm:mb-6 fade-in hidden sm:block" style="animation-delay: 0.15s"></div>
                                        <p class="text-base sm:text-lg text-gray-300 mb-6 sm:mb-8 max-w-lg fade-in" style="animation-delay: 0.2s">
                                            {{ $slide->subtitle }}
                                        </p>
                                    @endif
                                    <div class="fade-in flex flex-wrap gap-3" style="animation-delay: 0.3s">
                                        @if($slide->button_link)
                                            <a href="{{ $slide->button_link }}" class="btn btn-primary btn-lg">
                                                {{ $slide->button_text ?? 'Découvrir' }}
                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                                    <polyline points="12 5 19 12 12 19"></polyline>
                                                </svg>
                                            </a>
                                        @else
                                            <a href="{{ auth()->check() ? route('catalog.index') : route('register') }}" class="btn btn-primary btn-lg">
                                                {{ $slide->button_text ?? 'Découvrir' }}
                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                                    <polyline points="12 5 19 12 12 19"></polyline>
                                                </svg>
                                            </a>
                                        @endif
                                        @if($slide->button2_link)
                                            <a href="{{ $slide->button2_link }}" class="btn btn-outline btn-lg text-white border-white/30 hover:bg-white hover:text-black">
                                                {{ $slide->button2_text ?? 'En savoir plus' }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination hero-pagination"></div>
                <div class="swiper-button-prev hero-prev"></div>
                <div class="swiper-button-next hero-next"></div>
            </div>
        </section>
    @else
        <section class="hero" style="margin-top: 75px;">
            <div class="hero-bg" style="background-image: url('https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=1600&q=80');"></div>
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <div class="max-w-2xl">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-white mb-2 fade-in" style="animation-delay: 0.1s">
                        Chez   <span class="text-gradient">nous,</span> <br>on ne vend pas. On accueille.
                    </h1>
                    <div class="w-16 h-1 bg-brand-red mb-6 fade-in" style="animation-delay: 0.15s"></div>
                    <p class="text-lg text-gray-300 mb-8 max-w-lg fade-in" style="animation-delay: 0.2s">
                        La mode et la décoration s'invitent chez vous - pour un style qui a tout du raffinement. 
                    </p>
                    <div class="flex flex-wrap gap-4 fade-in" style="animation-delay: 0.3s">
                        <a href="{{ auth()->check() ? route('catalog.index') : route('register') }}" class="btn btn-primary btn-lg">
                            Découvrir le Catalogue
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-outline btn-lg text-white border-white/30 hover:bg-white hover:text-black">
                            Contactez Nous
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @auth
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
                    <a href="{{ route('catalog.index') }}" class="btn btn-primary btn-lg">
                        Voir tout le catalogue
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            @else
                <div class="text-center py-16">
                    <p class="text-gray-500 mb-6">Connectez-vous pour découvrir notre catalogue privé.</p>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                        Accéder au Catalogue
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            @endauth
        </div>
    </section>

    @auth
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
        @else
            <!-- <div class="text-center py-16">
                <p class="text-gray-500">Connectez-vous pour découvrir nos nouveautés et notre collection décoration.</p>
            </div> -->
        @endauth

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
                <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-10">
                    <div class="max-w-xl">
                        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Rejoignez notre communauté</h2>
                        <p class="text-gray-300 mb-6">Accédez à notre catalogue exclusif, recevez nos offres privilégiées et vivez l'expérience Home Store.</p>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                            Créer mon compte
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                    <div class="text-right">
                        <span class="text-6xl sm:text-7xl lg:text-8xl font-bold text-gold-400 counter" data-target="800">0</span>
                        <p class="text-gray-300 mt-2 text-base sm:text-lg">Déjà <span class="font-semibold text-white counter-text">0</span> personnes ont fait de notre maison la leur. À vous de pousser la porte.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .hero.has-swiper::before {
            display: none;
        }
        .hero-swiper {
            width: 100%;
            height: 100vh;
            min-height: 600px;
        }
        .hero-swiper .swiper-slide {
            position: relative;
        }
        .hero-pagination {
            bottom: 1.5rem !important;
        }
        .hero-pagination .swiper-pagination-bullet {
            width: 10px;
            height: 10px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 1;
            transition: all 0.3s;
        }
        .hero-pagination .swiper-pagination-bullet-active {
            background: #C18E41;
            width: 24px;
            border-radius: 4px;
        }
        .hero-prev, .hero-next {
            color: white;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            transition: all 0.3s;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero-prev:hover, .hero-next:hover {
            color: #E2B156;
        }
        .hero-prev {
            left: 1rem !important;
        }
        .hero-next {
            right: 1rem !important;
        }

        @media (max-width: 768px) {
            .hero-swiper {
                height: 100vh;
                min-height: 100svh;
            }
            .hero-prev, .hero-next {
                display: none !important;
            }
            .hero-pagination {
                bottom: 1.25rem !important;
            }
            .hero-pagination .swiper-pagination-bullet {
                width: 8px;
                height: 8px;
            }
            .hero-pagination .swiper-pagination-bullet-active {
                width: 20px;
            }
        }

        @media (min-width: 769px) {
            .hero-prev, .hero-next {
                display: flex !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof Swiper !== 'undefined') {
                new Swiper('.hero-swiper', {
                    loop: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                    pagination: {
                        el: '.hero-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.hero-next',
                        prevEl: '.hero-prev',
                    },
                    effect: 'fade',
                    fadeEffect: {
                        crossFade: true
                    },
                    speed: 1000,
                    grabCursor: false,
                    preventClicks: true,
                    preventClicksPropagation: true,
                    simulateTouch: true,
                    touchRatio: 1,
                    touchAngle: 45,
                    longSwipesRatio: 0.2,
                });
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.counter');
            const duration = 2000;

            const animateCounter = (counter) => {
                const target = parseInt(counter.getAttribute('data-target'), 10);
                const textEl = counter.parentElement.querySelector('.counter-text');
                const start = 0;
                const startTime = performance.now();

                const updateCounter = (currentTime) => {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    const easeOut = 1 - Math.pow(1 - progress, 3);
                    const current = Math.floor(start + (target - start) * easeOut);

                    counter.textContent = current.toLocaleString('fr-FR');
                    if (textEl) {
                        textEl.textContent = current.toLocaleString('fr-FR');
                    }

                    if (progress < 1) {
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target.toLocaleString('fr-FR');
                        if (textEl) {
                            textEl.textContent = target.toLocaleString('fr-FR');
                        }
                    }
                };

                requestAnimationFrame(updateCounter);
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            counters.forEach((counter) => observer.observe(counter));
        });
    </script>
@endpush

