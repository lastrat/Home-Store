@extends('layouts.app')

@section('title', 'Catalogue Privé - Home Store')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold mb-2">Mon Catalogue</h1>
                    <p class="text-gray-500">Découvrez notre collection exclusive</p>
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
                <aside class="lg:w-64 flex-shrink-0 lg:sticky lg:top-28 lg:self-start">
                    <div class="card p-6 space-y-6">
                        <div>
                            <h3 class="font-semibold text-sm uppercase tracking-wider mb-3">Famille</h3>
                            <div class="space-y-2">
                                <a href="{{ route('catalog.index') }}" class="block text-sm {{ !request('family') ? 'text-gold-600 font-semibold' : 'text-gray-600 hover:text-gold-600' }}">Tous</a>
                                <a href="{{ route('catalog.index', ['family' => 'mode']) }}" class="block text-sm {{ request('family') == 'mode' ? 'text-gold-600 font-semibold' : 'text-gray-600 hover:text-gold-600' }}">Mode</a>
                                <a href="{{ route('catalog.index', ['family' => 'decoration']) }}" class="block text-sm {{ request('family') == 'decoration' ? 'text-gold-600 font-semibold' : 'text-gray-600 hover:text-gold-600' }}">Décoration</a>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold text-sm uppercase tracking-wider mb-3">Catégories</h3>
                            <div class="space-y-2">
                                @foreach($categories as $category)
                                    <a href="{{ route('catalog.index', array_merge(request()->query(), ['category_id' => $category->id])) }}" class="block text-sm {{ request('category_id') == $category->id ? 'text-gold-600 font-semibold' : 'text-gray-600 hover:text-gold-600' }}">{{ $category->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold text-sm uppercase tracking-wider mb-3">Trier par</h3>
                            <select onchange="window.location.href=this.value" class="form-input text-sm">
                                <option value="{{ route('catalog.index', request()->except('sort')) }}" {{ !request('sort') ? 'selected' : '' }}>Par défaut</option>
                                <option value="{{ route('catalog.index', array_merge(request()->except('sort'), ['sort' => 'newest'])) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Plus récent</option>
                                <option value="{{ route('catalog.index', array_merge(request()->except('sort'), ['sort' => 'price_asc'])) }}" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                                <option value="{{ route('catalog.index', array_merge(request()->except('sort'), ['sort' => 'price_desc'])) }}" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                                <option value="{{ route('catalog.index', array_merge(request()->except('sort'), ['sort' => 'name'])) }}" {{ request('sort') == 'name' ? 'selected' : '' }}>Nom A-Z</option>
                            </select>
                        </div>
                    </div>
                </aside>

                <div class="flex-1">
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
