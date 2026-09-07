@extends('layouts.app')

@section('title', 'Gestion des Produits - Admin')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold">Produits</h1>
                    <p class="text-gray-500">Gestion du catalogue</p>
                </div>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Nouveau produit
                </a>
            </div>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="card mb-6">
                <form method="GET" action="{{ route('admin.products.index') }}" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-input flex-1" placeholder="Rechercher un produit...">
                    <select name="category_id" class="form-input">
                        <option value="">Toutes catégories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Filtrer</button>
                </form>
            </div>

            <div class="card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="data-table">
                        <thead>
                            <tr><th>Produit</th><th>Catégorie</th><th>Prix</th><th>Stock</th><th>Statut</th><th>Actions</th></tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                                                <img src="{{ $product->image1 ? asset('storage/' . $product->image1) : 'https://via.placeholder.com/40?text=' . urlencode($product->name) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                            </div>
                                            <span class="font-medium">{{ $product->name }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $product->category->name }}</td>
                                    <td class="font-semibold">{{ number_format($product->price, 0, ',', ' ') }} FCFA</td>
                                    <td>
                                        <span class="badge {{ $product->stock > 10 ? 'bg-green-100 text-green-700' : ($product->stock > 0 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                            {{ $product->stock }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $product->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                            {{ $product->is_active ? 'Actif' : 'Inactif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex gap-2">
                                            <a href="{{ route('admin.products.edit', $product) }}" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-600">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                </svg>
                                            </a>
                                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Supprimer ce produit ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 hover:bg-red-50 rounded-lg transition-colors">
                                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-red-500">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center py-8 text-gray-400">Aucun produit.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
