@extends('layouts.app')

@section('title', $product->name . ' - Home Store')

@section('content')
    <section class="pt-28 pb-8 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                <a href="{{ route('home') }}" class="hover:text-gold-600">Accueil</a>
                <span>/</span>
                <a href="{{ route('catalog.index') }}" class="hover:text-gold-600">Catalogue</a>
                <span>/</span>
                <span class="text-gray-900 font-medium">{{ $product->name }}</span>
            </nav>
        </div>
    </section>

    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <div class="gallery-grid">
                        @foreach($product->images as $image)
                            <div class="rounded-2xl overflow-hidden bg-gray-100">
                                <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                        @if($product->video_url)
                            <div class="rounded-2xl overflow-hidden bg-gray-100 flex items-center justify-center">
                                <video controls class="w-full h-full object-cover">
                                    <source src="{{ $product->video_url }}" type="video/mp4">
                                    Votre navigateur ne supporte pas les vidéos.
                                </video>
                            </div>
                        @endif
                        @for($i = count($product->images) + ($product->video_url ? 1 : 0); $i < 3; $i++)
                            <div class="rounded-2xl bg-gray-100 flex items-center justify-center text-gray-300">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                    <polyline points="21 15 16 10 5 21"></polyline>
                                </svg>
                            </div>
                        @endfor
                    </div>
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="badge badge-gold">{{ $product->category->name }}</span>
                        @if($product->badge)
                            @if($product->badge === 'nouveau')
                                <span class="badge badge-new">Nouveau</span>
                            @elseif($product->badge === 'coup_de_coeur')
                                <span class="badge badge-love">Coup de cœur</span>
                            @elseif($product->badge === 'bientot_epuise')
                                <span class="badge badge-warning">Bientôt épuisé</span>
                            @endif
                        @endif
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-bold mb-4">{{ $product->name }}</h1>
                    <p class="text-3xl font-bold text-gold-600 mb-6">{{ number_format($product->price, 0, ',', ' ') }} FCFA</p>
                    <p class="text-gray-600 mb-6 leading-relaxed">{{ $product->description }}</p>

                    @if($product->characteristics)
                        <div class="mb-6">
                            <h3 class="font-semibold mb-2">Caractéristiques</h3>
                            <p class="text-sm text-gray-600 whitespace-pre-line">{{ $product->characteristics }}</p>
                        </div>
                    @endif

                    <div class="mb-6">
                        <h3 class="font-semibold mb-2">Stock</h3>
                        @if($product->stock > 0)
                            <p class="text-sm text-green-600 font-medium">{{ $product->stock }} pièce(s) en stock</p>
                        @else
                            <p class="text-sm text-red-600 font-medium">Rupture de stock</p>
                        @endif
                    </div>

                    <div class="flex flex-wrap gap-3">
                        @if($product->stock > 0)
                            <form method="POST" action="{{ route('cart.add', $product) }}" class="flex gap-2">
                                @csrf
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-input w-20 text-center">
                                <button type="submit" class="btn btn-primary">
                                    Ajouter au panier
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <circle cx="9" cy="21" r="1"></circle>
                                        <circle cx="20" cy="21" r="1"></circle>
                                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                    </svg>
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('stock.alert.toggle', $product) }}" class="flex gap-2">
                                @csrf
                                <button type="submit" class="btn btn-outline">
                                    Me prévenir quand disponible
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                    </svg>
                                </button>
                            </form>
                        @endif
                        <form method="POST" action="{{ route('wishlist.toggle', $product) }}">
                            @csrf
                            <button type="submit" class="btn {{ $product->wishlists->isNotEmpty() ? 'btn-primary' : 'btn-outline' }}">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="{{ $product->wishlists->isNotEmpty() ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            @if($related->isNotEmpty())
                <div class="mt-20">
                    <h2 class="text-2xl font-bold mb-8">Vous aimerez aussi</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($related as $relatedProduct)
                            @include('components.product-card', ['product' => $relatedProduct])
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
