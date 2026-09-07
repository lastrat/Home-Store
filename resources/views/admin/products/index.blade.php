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
                <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-input pl-10" placeholder="Rechercher un produit...">
                    </div>
                    <select name="category_id" class="form-input sm:w-56">
                        <option value="">Toutes catégories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div class="flex gap-2">
                        <button type="submit" class="btn btn-primary whitespace-nowrap">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            Filtrer
                        </button>
                    </div>
                </form>
            </div>

            <div class="card overflow-hidden">
                <div class="flex items-center justify-between p-4 border-b border-gray-100">
                    <p class="text-sm text-gray-500">{{ $products->total() }} produit(s)</p>
                    <div class="flex items-center gap-1 bg-gray-100 p-1 rounded-lg">
                        <button type="button" id="view-table" class="admin-view-toggle p-2 rounded-md bg-white shadow-sm text-gray-900" data-view="table">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                        </button>
                        <button type="button" id="view-grid" class="admin-view-toggle p-2 rounded-md text-gray-500 hover:text-gray-900" data-view="grid">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                        </button>
                    </div>
                </div>

                <div id="admin-products-table" class="overflow-x-auto">
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

                <div id="admin-products-grid" class="hidden p-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        @forelse($products as $product)
                            <div class="card p-4 flex flex-col">
                                <div class="aspect-video rounded-xl bg-gray-100 overflow-hidden mb-3">
                                    <img src="{{ $product->image1 ? asset('storage/' . $product->image1) : 'https://via.placeholder.com/400x300?text=' . urlencode($product->name) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs text-gold-600 font-medium uppercase tracking-wider mb-1">{{ $product->category->name }}</p>
                                    <h4 class="font-semibold text-sm mb-1 line-clamp-2">{{ $product->name }}</h4>
                                    <p class="text-sm font-bold text-gold-600">{{ number_format($product->price, 0, ',', ' ') }} FCFA</p>
                                </div>
                                <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-100">
                                    <span class="badge {{ $product->stock > 10 ? 'bg-green-100 text-green-700' : ($product->stock > 0 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                        {{ $product->stock }} en stock
                                    </span>
                                    <div class="flex gap-1">
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
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12 text-gray-400">Aucun produit.</div>
                        @endforelse
                    </div>
                </div>

                <div class="p-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tableBtn = document.getElementById('view-table');
            const gridBtn = document.getElementById('view-grid');
            const tableView = document.getElementById('admin-products-table');
            const gridView = document.getElementById('admin-products-grid');

            function setView(view) {
                if (view === 'table') {
                    tableView.classList.remove('hidden');
                    gridView.classList.add('hidden');
                    tableBtn.classList.add('bg-white', 'shadow-sm', 'text-gray-900');
                    tableBtn.classList.remove('text-gray-500');
                    gridBtn.classList.remove('bg-white', 'shadow-sm', 'text-gray-900');
                    gridBtn.classList.add('text-gray-500');
                } else {
                    tableView.classList.add('hidden');
                    gridView.classList.remove('hidden');
                    gridBtn.classList.add('bg-white', 'shadow-sm', 'text-gray-900');
                    gridBtn.classList.remove('text-gray-500');
                    tableBtn.classList.remove('bg-white', 'shadow-sm', 'text-gray-900');
                    tableBtn.classList.add('text-gray-500');
                }
            }

            tableBtn.addEventListener('click', () => setView('table'));
            gridBtn.addEventListener('click', () => setView('grid'));
        });
    </script>
@endpush
        </div>
    </section>
@endsection
