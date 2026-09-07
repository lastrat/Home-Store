@extends('layouts.app')

@section('title', $product->name . ' - Home Store')

@section('content')
    <section class="pt-28 pb-8 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-gold-600 transition-colors">Accueil</a>
                <span class="text-gray-300">/</span>
                <a href="{{ route('catalog.index') }}" class="hover:text-gold-600 transition-colors">Catalogue</a>
                <span class="text-gray-300">/</span>
                <span class="text-gray-900 font-medium truncate">{{ $product->name }}</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <div class="sticky top-28">
                        <div class="relative rounded-2xl overflow-hidden bg-gray-100 aspect-square mb-4 group">
                            <img id="main-product-image" src="{{ $product->image1 ? asset('storage/' . $product->image1) : 'https://via.placeholder.com/800x800?text=' . urlencode($product->name) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @if($product->badge === 'nouveau')
                                <span class="badge badge-new absolute top-4 left-4">Nouveau</span>
                            @elseif($product->badge === 'coup_de_coeur')
                                <span class="badge badge-love absolute top-4 left-4">Coup de cœur</span>
                            @elseif($product->badge === 'bientot_epuise')
                                <span class="badge badge-warning absolute top-4 left-4">Bientôt épuisé</span>
                            @endif
                            @if($product->is_out_of_stock)
                                <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                                    <span class="text-white font-bold text-2xl">Rupture de stock</span>
                                </div>
                            @endif
                        </div>

                        <div class="grid grid-cols-4 gap-3">
                            @foreach($product->images as $index => $image)
                                <button class="thumbnail-btn rounded-xl overflow-hidden bg-gray-100 aspect-square border-2 border-transparent hover:border-gold-500 transition-all {{ $index === 0 ? 'border-gold-500 ring-2 ring-gold-200' : '' }}" data-image="{{ asset('storage/' . $image) }}">
                                    <img src="{{ asset('storage/' . $image) }}" alt="Thumbnail {{ $index + 1 }}" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                            @for($i = count($product->images); $i < 3; $i++)
                                <div class="rounded-xl bg-gray-100 aspect-square flex items-center justify-center text-gray-300">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                        <polyline points="21 15 16 10 5 21"></polyline>
                                    </svg>
                                </div>
                            @endfor
                        </div>

                        @if($product->video_url)
                            <div class="mt-4">
                                <h4 class="text-sm font-semibold mb-2">Vidéo du produit</h4>
                                <div class="rounded-2xl overflow-hidden bg-gray-100 aspect-video">
                                    <video controls class="w-full h-full object-cover">
                                        <source src="{{ $product->video_url }}" type="video/mp4">
                                        Votre navigateur ne supporte pas les vidéos.
                                    </video>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="badge badge-gold">{{ $product->category->name }}</span>
                        @if($product->stock > 0 && $product->stock <= 3)
                            <span class="badge badge-warning">Plus que {{ $product->stock }} en stock</span>
                        @endif
                    </div>

                    <h1 class="text-3xl sm:text-4xl font-bold mb-4 text-gray-900">{{ $product->name }}</h1>

                    <div class="flex items-baseline gap-3 mb-6">
                        <p class="text-4xl font-bold text-gold-600">{{ number_format($product->price, 0, ',', ' ') }} FCFA</p>
                    </div>

                    <div class="prose prose-sm text-gray-600 mb-8 leading-relaxed">
                        {{ $product->description }}
                    </div>

                    @if($product->characteristics)
                        <div class="mb-8">
                            <h3 class="text-lg font-bold mb-3">Caractéristiques</h3>
                            <div class="bg-gray-50 rounded-2xl p-6">
                                <p class="text-sm text-gray-600 whitespace-pre-line">{{ $product->characteristics }}</p>
                            </div>
                        </div>
                    @endif

                    @if($product->variants->isNotEmpty())
                        <div class="mb-8">
                            <h3 class="text-lg font-bold mb-4">Déclinaisons disponibles</h3>
                            <div class="bg-gray-50 rounded-2xl p-6 space-y-5">
                                @php
                                    $groupedBySize = $product->variants->groupBy('size');
                                    $groupedByColor = $product->variants->groupBy('color');
                                    $groupedByMaterial = $product->variants->groupBy('material');
                                @endphp

                                @if($groupedBySize->count() > 1)
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Taille</label>
                                        <div class="flex flex-wrap gap-2" id="variant-size-options">
                                            @foreach($groupedBySize as $size => $variants)
                                                <button type="button" data-variant-size="{{ $size }}" class="variant-size-btn px-4 py-2 rounded-xl border-2 border-gray-200 text-sm font-medium hover:border-gold-400 transition-all">
                                                    {{ $size }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if($groupedByColor->count() > 1)
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Couleur</label>
                                        <div class="flex flex-wrap gap-2" id="variant-color-options">
                                            @foreach($groupedByColor as $color => $variants)
                                                <button type="button" data-variant-color="{{ $color }}" class="variant-color-btn px-4 py-2 rounded-xl border-2 border-gray-200 text-sm font-medium hover:border-gold-400 transition-all">
                                                    {{ $color }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if($groupedByMaterial->count() > 1)
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Matière</label>
                                        <div class="flex flex-wrap gap-2" id="variant-material-options">
                                            @foreach($groupedByMaterial as $material => $variants)
                                                <button type="button" data-variant-material="{{ $material }}" class="variant-material-btn px-4 py-2 rounded-xl border-2 border-gray-200 text-sm font-medium hover:border-gold-400 transition-all">
                                                    {{ $material }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div id="selected-variant-info" class="hidden">
                                    <div class="flex items-center gap-3 p-4 bg-white rounded-xl border border-gold-200">
                                        <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                                        <p class="text-sm">
                                            <span class="font-semibold">Variante sélectionnée:</span>
                                            <span id="selected-variant-label" class="text-gray-700"></span>
                                            <span class="text-gray-400">|</span>
                                            <span id="selected-variant-stock" class="text-green-600 font-medium"></span>
                                            <span class="text-gray-400">|</span>
                                            <span id="selected-variant-price" class="text-gold-600 font-bold"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="mb-8">
                        <h3 class="text-lg font-bold mb-3">Disponibilité</h3>
                        <div class="flex items-center gap-2">
                            @if($product->stock > 0)
                                <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                                <p class="text-sm text-green-600 font-medium">{{ $product->stock }} pièce(s) en stock</p>
                            @else
                                <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                <p class="text-sm text-red-600 font-medium">Rupture de stock</p>
                            @endif
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3 mb-8">
                        @php
                            $hasVariants = $product->variants->isNotEmpty();
                            $hasStock = $product->stock > 0 || $product->variants->where('stock', '>', 0)->count() > 0;
                        @endphp

                        @if($hasVariants)
                            <input type="hidden" id="selected-variant-id" value="">
                        @endif

                        @if($hasStock)
                            <div class="flex gap-2">
                                <div class="relative">
                                    <button class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600" onclick="decrementQty()">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    </button>
                                    <input type="number" id="qty-{{ $product->id }}" value="1" min="1" max="{{ $product->stock }}" class="form-input w-20 text-center pl-8 pr-8">
                                    <button class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600" onclick="incrementQty()">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    </button>
                                </div>
                                <button class="btn btn-primary cart-add-btn" data-product-id="{{ $product->id }}" {{ $hasVariants ? 'disabled' : '' }}>
                                    Ajouter au panier
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <circle cx="9" cy="21" r="1"></circle>
                                        <circle cx="20" cy="21" r="1"></circle>
                                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                    </svg>
                                </button>
                            </div>
                        @else
                            <button class="btn btn-outline stock-alert-btn" data-product-id="{{ $product->id }}">
                                Me prévenir quand disponible
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                </svg>
                            </button>
                        @endif

                        <button class="btn {{ $product->wishlists->isNotEmpty() ? 'btn-primary' : 'btn-outline' }} wishlist-toggle-btn" data-product-id="{{ $product->id }}" title="Coup de cœur">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="{{ $product->wishlists->isNotEmpty() ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Informations</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Catégorie</span>
                                <span class="font-medium">{{ $product->category->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Référence</span>
                                <span class="font-mono text-xs">{{ $product->id }}</span>
                            </div>
                            @if($product->characteristics)
                                @php
                                    $chars = array_filter(array_map('trim', explode(',', $product->characteristics)));
                                @endphp
                                @foreach($chars as $char)
                                    @php
                                        $parts = array_filter(explode(':', $char));
                                        if (count($parts) >= 2) {
                                            $label = trim($parts[0]);
                                            $value = trim($parts[1]);
                                        } else {
                                            $label = 'Information';
                                            $value = trim($char);
                                        }
                                    @endphp
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">{{ $label }}</span>
                                        <span class="font-medium">{{ $value }}</span>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if($related->isNotEmpty())
                <div class="mt-24">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="text-2xl font-bold mb-1">Vous aimerez aussi</h2>
                            <p class="text-sm text-gray-500">Des produits similaires qui pourraient vous plaire</p>
                        </div>
                        <a href="{{ route('catalog.index', ['category_id' => $product->category_id]) }}" class="btn btn-outline hidden sm:flex">
                            Voir tout
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($related as $relatedProduct)
                            @include('components.product-card', ['product' => $relatedProduct])
                        @endforeach
                    </div>
                    <div class="text-center mt-8 sm:hidden">
                        <a href="{{ route('catalog.index', ['category_id' => $product->category_id]) }}" class="btn btn-outline">
                            Voir tout
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const variants = @json($product->variants);
        let selectedVariant = null;

        function incrementQty(max) {
            const input = document.getElementById('qty-{{ $product->id }}');
            const currentMax = max || (selectedVariant ? selectedVariant.stock : {{ $product->stock }});
            if (input && parseInt(input.value) < currentMax) {
                input.value = parseInt(input.value) + 1;
            }
        }

        function decrementQty() {
            const input = document.getElementById('qty-{{ $product->id }}');
            if (input && parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        function updateSelectedVariant() {
            const size = document.querySelector('.variant-size-btn.selected')?.dataset.variantSize || null;
            const color = document.querySelector('.variant-color-btn.selected')?.dataset.variantColor || null;
            const material = document.querySelector('.variant-material-btn.selected')?.dataset.variantMaterial || null;

            selectedVariant = variants.find(v => {
                const matchSize = !size || v.size === size;
                const matchColor = !color || v.color === color;
                const matchMaterial = !material || v.material === material;
                return matchSize && matchColor && matchMaterial;
            });

            const infoDiv = document.getElementById('selected-variant-info');
            const addBtn = document.querySelector('.cart-add-btn');
            const qtyInput = document.getElementById('qty-{{ $product->id }}');

            if (selectedVariant) {
                infoDiv.classList.remove('hidden');
                document.getElementById('selected-variant-label').textContent = [selectedVariant.size, selectedVariant.color, selectedVariant.material].filter(Boolean).join(' / ') || 'Standard';
                document.getElementById('selected-variant-stock').textContent = selectedVariant.stock > 0 ? `${selectedVariant.stock} en stock` : 'Rupture de stock';
                document.getElementById('selected-variant-price').textContent =
                new Intl.NumberFormat('fr-FR').format(
                    Number({{ $product->price }}) + Number(selectedVariant.price_adjustment || 0)
                ) + ' FCFA';
                document.getElementById('selected-variant-id').value = selectedVariant.id;
                addBtn.disabled = selectedVariant.stock <= 0;
                if (qtyInput) qtyInput.max = Math.max(1, selectedVariant.stock);
            } else {
                infoDiv.classList.add('hidden');
                addBtn.disabled = true;
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const mainImage = document.getElementById('main-product-image');
            const thumbnails = document.querySelectorAll('.thumbnail-btn');

            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', () => {
                    const newSrc = thumb.dataset.image;
                    mainImage.src = newSrc;

                    thumbnails.forEach(t => {
                        t.classList.remove('border-gold-500', 'ring-2', 'ring-gold-200');
                        t.classList.add('border-transparent');
                    });
                    thumb.classList.remove('border-transparent');
                    thumb.classList.add('border-gold-500', 'ring-2', 'ring-gold-200');
                });
            });

            document.querySelectorAll('.variant-size-btn, .variant-color-btn, .variant-material-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const siblings = this.parentElement.querySelectorAll('button');
                    siblings.forEach(s => {
                        s.classList.remove('border-gold-500', 'bg-gold-50', 'text-gold-700');
                        s.classList.add('border-gray-200');
                    });
                    this.classList.remove('border-gray-200');
                    this.classList.add('border-gold-500', 'bg-gold-50', 'text-gold-700');
                    updateSelectedVariant();
                });
            });

            if (variants.length === 1) {
                selectedVariant = variants[0];
                updateSelectedVariant();
            }
        });
    </script>
@endpush
