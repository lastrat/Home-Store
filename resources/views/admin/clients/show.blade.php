@extends('layouts.app')

@section('title', $client->name . ' - Admin')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.clients.index') }}" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold">{{ $client->name }}</h1>
                    <p class="text-gray-500">Profil client</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-1">
                    <div class="card p-6 text-center">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gradient-to-br from-gold-400 to-gold-600 flex items-center justify-center text-black font-bold text-2xl">
                            {{ substr($client->name, 0, 1) }}
                        </div>
                        <h2 class="text-xl font-bold">{{ $client->name }}</h2>
                        <p class="text-gray-500 text-sm">{{ $client->email }}</p>
                        <div class="mt-6 space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Téléphone</span>
                                <span class="font-medium">{{ $client->phone }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Naissance</span>
                                <span class="font-medium">{{ $client->birthdate ? $client->birthdate->format('d/m/Y') : '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Âge</span>
                                <span class="font-medium">{{ $client->age ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Profession</span>
                                <span class="font-medium">{{ $client->profession ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Quartier</span>
                                <span class="font-medium">{{ $client->neighborhood?->name ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Inscrit le</span>
                                <span class="font-medium">{{ $client->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <div class="card p-6">
                        <h3 class="font-bold text-lg mb-4">Commandes ({{ $orders->total() }})</h3>
                        <div class="space-y-3">
                            @forelse($orders as $order)
                                <a href="{{ route('admin.orders.show', $order) }}" class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                                    <div>
                                        <p class="font-mono font-bold text-sm">{{ $order->order_number }}</p>
                                        <p class="text-sm text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-gold-600">{{ number_format($order->total, 0, ',', ' ') }} FCFA</p>
                                        <span class="badge badge-gold text-xs">{{ $order->status }}</span>
                                    </div>
                                </a>
                            @empty
                                <p class="text-gray-400 text-center py-8">Aucune commande.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
