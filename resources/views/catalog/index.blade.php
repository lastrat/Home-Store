@extends('layouts.app')

@section('title', 'Catalogue Privé - Home Store')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold mb-2">Mon Catalogue</h1>
                    <p class="text-gray-500">Découvrez notre collection exclusive</p>
                    <div class="w-12 h-1 bg-brand-red mt-3"></div>
                </div>
                <form method="GET" action="{{ route('catalog.index') }}" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-input" placeholder="Rechercher..." style="min-width: 200px;">
                    <button type="submit" class="btn btn-primary">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <aside class="lg:w-72 flex-shrink-0 lg:sticky lg:top-28 lg:self-start space-y-6">
                    <div class="card p-6 space-y-6">
                        <div>
                            <h3 class="font-semibold text-sm uppercase tracking-wider mb-3">Famille</h3>
                            <div class="space-y-2">
                                <a href="{{ route('catalog.index') }}" class="flex items-center gap-2 text-sm {{ !request('family') ? 'text-gold-600 font-semibold' : 'text-gray-600 hover:text-gold-600' }}">
                                    <span class="w-2 h-2 rounded-full {{ !request('family') ? 'bg-gold-500' : 'bg-gray-300' }}"></span>
                                    Tous
                                </a>
                                @foreach($categories as $family)
                                    <a href="{{ route('catalog.index', ['family' => $family->slug]) }}" class="flex items-center gap-2 text-sm {{ request('family') == $family->slug ? 'text-gold-600 font-semibold' : 'text-gray-600 hover:text-gold-600' }}">
                                        <span class="w-2 h-2 rounded-full {{ request('family') == $family->slug ? 'bg-gold-500' : 'bg-gray-300' }}"></span>
                                        {{ $family->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-4">
                            <h3 class="font-semibold text-sm uppercase tracking-wider mb-3">Sous-catégories</h3>
                            @if(request('family'))
                                <div class="space-y-2 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                                    @foreach($subcategories as $subcategory)
                                        <a href="{{ route('catalog.index', array_merge(request()->query(), ['category_id' => $subcategory->id])) }}" class="flex items-center gap-2 text-sm {{ request('category_id') == $subcategory->id ? 'text-gold-600 font-semibold' : 'text-gray-600 hover:text-gold-600' }}">
                                            <span class="flex-1">{{ $subcategory->name }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-400">Sélectionnez une famille pour voir les sous-catégories.</p>
                            @endif
                        </div>

                        <div class="border-t border-gray-100 pt-4">
                            <h3 class="font-semibold text-sm uppercase tracking-wider mb-3">Taille</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach(['S', 'M', 'L', 'XL', 'Unique'] as $size)
                                    <a href="{{ route('catalog.index', array_merge(request()->except('size'), ['size' => $size])) }}" class="px-3 py-1.5 rounded-lg text-xs font-medium border transition-all {{ request('size') == $size ? 'bg-gold-500 text-black border-gold-500' : 'bg-white text-gray-600 border-gray-200 hover:border-gold-300' }}">
                                        {{ $size }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-4">
                            <h3 class="font-semibold text-sm uppercase tracking-wider mb-3">Prix</h3>
                            <div class="flex items-center gap-2">
                                <input type="number" name="min_price" value="{{ request('min_price') }}" class="form-input text-sm" placeholder="Min" min="0">
                                <span class="text-gray-400">-</span>
                                <input type="number" name="max_price" value="{{ request('max_price') }}" class="form-input text-sm" placeholder="Max" min="0">
                            </div>
                            <button type="submit" form="price-filter-form" class="btn btn-primary btn-sm w-full mt-2">Appliquer</button>
                            <form id="price-filter-form" method="GET" action="{{ route('catalog.index') }}" class="hidden">
                                @foreach(request()->except('min_price', 'max_price') as $key => $value)
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach
                            </form>
                        </div>

                        <div class="border-t border-gray-100 pt-4">
                            <h3 class="font-semibold text-sm uppercase tracking-wider mb-3">Couleur</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($colors as $color)
                                    <a href="{{ route('catalog.index', array_merge(request()->except('color'), ['color' => $color])) }}" class="px-3 py-1.5 rounded-lg text-xs font-medium border transition-all {{ request('color') == $color ? 'bg-gold-500 text-black border-gold-500' : 'bg-white text-gray-600 border-gray-200 hover:border-gold-300' }}">
                                        {{ $color }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-4">
                            <h3 class="font-semibold text-sm uppercase tracking-wider mb-3">Matière</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($materials as $material)
                                    <a href="{{ route('catalog.index', array_merge(request()->except('material'), ['material' => $material])) }}" class="px-3 py-1.5 rounded-lg text-xs font-medium border transition-all {{ request('material') == $material ? 'bg-gold-500 text-black border-gold-500' : 'bg-white text-gray-600 border-gray-200 hover:border-gold-300' }}">
                                        {{ $material }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        @if(request()->hasAny(['family', 'category_id', 'size', 'color', 'material', 'min_price', 'max_price']))
                            <div class="border-t border-gray-100 pt-4">
                                <a href="{{ route('catalog.index') }}" class="btn btn-outline btn-sm w-full">Réinitialiser les filtres</a>
                            </div>
                        @endif
                    </div>
                </aside>

                <div class="flex-1">
                    <div class="flex items-center justify-between mb-6">
                        <p class="text-sm text-gray-500">{{ $products->total() }} produit(s)</p>
                        <select onchange="window.location.href=this.value" class="form-input text-sm">
                            <option value="{{ route('catalog.index', request()->except('sort')) }}" {{ !request('sort') ? 'selected' : '' }}>Par défaut</option>
                            <option value="{{ route('catalog.index', array_merge(request()->except('sort'), ['sort' => 'newest'])) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Plus récent</option>
                            <option value="{{ route('catalog.index', array_merge(request()->except('sort'), ['sort' => 'price_asc'])) }}" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                            <option value="{{ route('catalog.index', array_merge(request()->except('sort'), ['sort' => 'price_desc'])) }}" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                            <option value="{{ route('catalog.index', array_merge(request()->except('sort'), ['sort' => 'name'])) }}" {{ request('sort') == 'name' ? 'selected' : '' }}>Nom A-Z</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($products as $product)
                            @include('components.product-card', ['product' => $product])
                        @empty
                            <div class="col-span-full text-center py-16">
                                <p class="text-gray-400">Aucun produit trouvé.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-12">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.like-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const productId = this.dataset.productId;
                    fetch(`/produit/${productId}/like`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Not authenticated');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.liked) {
                            this.classList.add('text-gold-500');
                            this.querySelector('svg').setAttribute('fill', 'currentColor');
                        } else {
                            this.classList.remove('text-gold-500');
                            this.querySelector('svg').setAttribute('fill', 'none');
                        }
                    })
                    .catch(error => {
                        console.error('Like error:', error);
                        if (error.message === 'Not authenticated') {
                            alert('Veuillez vous connecter pour aimer ce produit.');
                        }
                    });
                });
            });

            document.querySelectorAll('.interest-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const productId = this.dataset.productId;
                    fetch(`/produit/${productId}/interest`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Not authenticated');
                        }
                        return response.json();
                    })
                    .then(data => {
                        alert(data.message);
                    })
                    .catch(error => {
                        console.error('Interest error:', error);
                        if (error.message === 'Not authenticated') {
                            alert('Veuillez vous connecter pour être notifié.');
                        }
                    });
                });
            });
        });
    </script>
@endpush

