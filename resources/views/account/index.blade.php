@extends('layouts.app')

@section('title', 'Mon Compte - Home Store')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl sm:text-4xl font-bold mb-2">Mon Compte</h1>
            <p class="text-gray-500">Bienvenue, {{ $user->name }}</p>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <aside class="lg:col-span-1">
                    <div class="card p-6 space-y-2">
                        <a href="{{ route('account.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-gold-50 text-gold-700 font-medium">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            Profil
                        </a>
                        <a href="{{ route('account.orders') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-700 transition-colors">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                            </svg>
                            Mes Commandes
                        </a>
                        <a href="{{ route('account.wishlists') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-700 transition-colors">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                            Coups de Cœur
                        </a>
                        <a href="{{ route('account.alerts') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-700 transition-colors">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                            </svg>
                            Alertes Stock
                        </a>
                    </div>
                </aside>

                <div class="lg:col-span-3 space-y-8">
                    <div class="card p-8">
                        <h2 class="text-xl font-bold mb-6">Informations personnelles</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold mb-2">Nom</label>
                                <p class="text-gray-600">{{ $user->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-2">Email</label>
                                <p class="text-gray-600">{{ $user->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-2">Téléphone</label>
                                <p class="text-gray-600">{{ $user->phone }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-2">Date de naissance</label>
                                <p class="text-gray-600">{{ $user->birthdate ? $user->birthdate->format('d/m/Y') : '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-2">Profession</label>
                                <p class="text-gray-600">{{ $user->profession ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-2">Quartier</label>
                                <p class="text-gray-600">{{ $user->neighborhood?->name ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <a href="{{ route('account.orders') }}" class="card p-6 text-center hover:border-gold-300 border-2 border-transparent">
                            <div class="text-2xl font-bold text-gold-600">{{ $orders->total() }}</div>
                            <div class="text-sm text-gray-500">Commandes</div>
                        </a>
                        <a href="{{ route('account.wishlists') }}" class="card p-6 text-center hover:border-gold-300 border-2 border-transparent">
                            <div class="text-2xl font-bold text-gold-600">{{ $wishlists->total() }}</div>
                            <div class="text-sm text-gray-500">Favoris</div>
                        </a>
                        <a href="{{ route('account.alerts') }}" class="card p-6 text-center hover:border-gold-300 border-2 border-transparent">
                            <div class="text-2xl font-bold text-gold-600">{{ $stockAlerts->total() }}</div>
                            <div class="text-sm text-gray-500">Alertes</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

