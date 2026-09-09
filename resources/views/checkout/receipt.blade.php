@extends('layouts.app')

@section('title', 'Reçu - ' . $order->order_number . ' - Home Store')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold mb-2">Commande Confirmée</h1>
                    <p class="text-gray-500">Numéro: <span class="font-mono font-bold text-gray-900">{{ $order->order_number }}</span></p>
                </div>
                <a href="{{ route('checkout.receipt.download', $order) }}" class="btn btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    Télécharger le reçu
                </a>
            </div>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="card p-8 mb-8">
                <div class="flex items-center justify-center mb-8">
                    <div class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-green-600">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                </div>
                <h2 class="text-2xl font-bold text-center mb-2">Félicitations !</h2>
                <p class="text-gray-500 text-center mb-8">Votre commande a été enregistrée avec succès.</p>

                <div class="bg-gray-50 rounded-2xl p-6 mb-6">
                    <h3 class="font-bold mb-4">Détails de la commande</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Numéro de commande</span>
                            <span class="font-mono font-bold">{{ $order->order_number }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Date</span>
                            <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Mode de paiement</span>
                            <span class="font-medium">{{ match($order->payment_method) { 'boutique' => 'Paiement en boutique', 'mobile_money' => 'Mobile Money', 'virement' => 'Virement', 'livraison' => 'À la livraison', default => $order->payment_method } }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Statut</span>
                            <span class="badge badge-gold">{{ match($order->status) { 'en_attente' => 'En attente', 'valide' => 'Validé', 'paye' => 'Payé', 'recupere' => 'Récupéré', 'annule' => 'Annulé', default => $order->status } }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-2xl p-6 mb-6">
                    <h3 class="font-bold mb-4">Articles</h3>
                    <div class="space-y-3">
                        @foreach($order->items as $item)
                            <div class="flex justify-between text-sm">
                                <div>
                                    <p class="font-medium">{{ $item->product_name }}</p>
                                    <p class="text-gray-500">x{{ $item->quantity }} × {{ number_format($item->product_price, 0, ',', ' ') }} FCFA</p>
                                </div>
                                <span class="font-semibold">{{ number_format($item->subtotal, 0, ',', ' ') }} FCFA</span>
                            </div>
                        @endforeach
                        <div class="border-t border-gray-200 pt-3 mt-3">
                            <div class="flex justify-between font-bold text-lg">
                                <span>Total</span>
                                <span class="text-gold-600">{{ number_format($order->total, 0, ',', ' ') }} FCFA</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gold-50 border border-gold-200 rounded-2xl p-6">
                    <h3 class="font-bold mb-2 text-gold-800">Instructions</h3>
                    <p class="text-sm text-gold-700">Présentez ce reçu en boutique pour finaliser votre paiement et récupérer vos articles. Réservation valable 48h.</p>
                </div>
            </div>
        </div>
    </section>
@endsection

