@extends('layouts.app')

@section('title', 'Commande ' . $order->order_number . ' - Home Store')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('account.orders') }}" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold">Commande {{ $order->order_number }}</h1>
                    <p class="text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="card p-8 mb-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold">Détails</h2>
                    <span class="badge badge-gold">{{ match($order->status) { 'en_attente' => 'En attente', 'valide' => 'Validé', 'paye' => 'Payé', 'recupere' => 'Récupéré', 'annule' => 'Annulé', default => $order->status } }}</span>
                </div>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Mode de paiement</span>
                        <span class="font-medium">{{ match($order->payment_method) { 'boutique' => 'Paiement en boutique', 'mobile_money' => 'Mobile Money', 'virement' => 'Virement', 'livraison' => 'À la livraison', default => $order->payment_method } }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Total</span>
                        <span class="font-bold text-gold-600">{{ number_format($order->total, 0, ',', ' ') }} FCFA</span>
                    </div>
                </div>
            </div>

            <div class="card p-8">
                <h2 class="text-xl font-bold mb-6">Articles</h2>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                                <img src="{{ $item->product->image1 ? asset('storage/' . $item->product->image1) : 'https://via.placeholder.com/100?text=' . urlencode($item->product_name) }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <p class="font-medium">{{ $item->product_name }}</p>
                                <p class="text-sm text-gray-500">x{{ $item->quantity }}</p>
                            </div>
                            <p class="font-semibold">{{ number_format($item->subtotal, 0, ',', ' ') }} FCFA</p>
                        </div>
                    @endforeach
                </div>
                <div class="border-t border-gray-100 mt-6 pt-4">
                    <div class="flex justify-between text-lg font-bold">
                        <span>Total</span>
                        <span class="text-gold-600">{{ number_format($order->total, 0, ',', ' ') }} FCFA</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
