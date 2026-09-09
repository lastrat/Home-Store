@extends('layouts.app')

@section('title', 'Admin - Tableau de bord')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold">Tableau de bord</h1>
            <p class="text-gray-500">Vue d'ensemble de votre boutique</p>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <div class="card p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gold-100 flex items-center justify-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gold-600">
                                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                <line x1="7" y1="7" x2="7.01" y2="7"></line>
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mb-1">Produits</p>
                    <p class="text-3xl font-bold">{{ $stats['products'] }}</p>
                </div>
                <div class="card p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-blue-600">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mb-1">Commandes</p>
                    <p class="text-3xl font-bold">{{ $stats['orders'] }}</p>
                </div>
                <div class="card p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-green-600">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mb-1">Clients</p>
                    <p class="text-3xl font-bold">{{ $stats['clients'] }}</p>
                </div>
                <div class="card p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-brand-red">
                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mb-1">Revenus</p>
                    <p class="text-3xl font-bold">{{ number_format($stats['revenue'], 0, ',', ' ') }} FCFA</p>
                </div>
            </div>

            <div class="mb-12">
                <h3 class="font-bold text-lg mb-4">Gestion</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <a href="{{ route('admin.products.index') }}" class="card p-6 flex items-center gap-4 hover:border-gold-300 border-2 border-transparent transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-gold-100 flex items-center justify-center flex-shrink-0">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gold-600">
                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                            <line x1="7" y1="7" x2="7.01" y2="7"></line>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold">Produits</p>
                        <p class="text-sm text-gray-500">Catalogue & stocks</p>
                    </div>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-400 group-hover:text-gold-600 transition-colors">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="card p-6 flex items-center gap-4 hover:border-gold-300 border-2 border-transparent transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-orange-100 flex items-center justify-center flex-shrink-0">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-orange-600">
                            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold">Catégories</p>
                        <p class="text-sm text-gray-500">Familles & sous-catégories</p>
                    </div>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-400 group-hover:text-gold-600 transition-colors">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="card p-6 flex items-center gap-4 hover:border-gold-300 border-2 border-transparent transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-blue-600">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold">Commandes</p>
                        <p class="text-sm text-gray-500">Suivi & statuts</p>
                    </div>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-400 group-hover:text-gold-600 transition-colors">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
                <a href="{{ route('admin.clients.index') }}" class="card p-6 flex items-center gap-4 hover:border-gold-300 border-2 border-transparent transition-all group">
                    <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center flex-shrink-0">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-green-600">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold">Clients</p>
                        <p class="text-sm text-gray-500">Base clients & données</p>
                    </div>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-400 group-hover:text-gold-600 transition-colors">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="card p-6">
                    <h3 class="font-bold text-lg mb-4">Commandes récentes</h3>
                    <div class="overflow-x-auto">
                        <table class="data-table">
                            <thead>
                                <tr><th>N°</th><th>Client</th><th>Total</th><th>Statut</th></tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                    <tr>
                                        <td class="font-mono text-sm">{{ $order->order_number }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ number_format($order->total, 0, ',', ' ') }} FCFA</td>
                                        <td><span class="badge badge-gold">{{ $order->status }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card p-6">
                    <h3 class="font-bold text-lg mb-4">Produits populaires</h3>
                    <div class="space-y-4">
                        @foreach($topProducts as $product)
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0">
                                    <img src="{{ $product->image1 ? asset('storage/' . $product->image1) : 'https://via.placeholder.com/50?text=' . urlencode($product->name) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-sm">{{ $product->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $product->order_items_count }} ventes</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

