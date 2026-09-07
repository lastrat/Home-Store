@extends('layouts.app')

@section('title', 'Mes Commandes - Home Store')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl sm:text-4xl font-bold mb-2">Mes Commandes</h1>
            <p class="text-gray-500">Historique de vos commandes</p>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-4">
                @forelse($orders as $order)
                    <a href="{{ route('account.order.show', $order) }}" class="card p-6 flex items-center justify-between hover:border-gold-300 border-2 border-transparent transition-all block">
                        <div>
                            <p class="font-mono font-bold text-sm mb-1">{{ $order->order_number }}</p>
                            <p class="text-sm text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-gold-600">{{ number_format($order->total, 0, ',', ' ') }} FCFA</p>
                            <span class="badge badge-gold mt-1">{{ match($order->status) { 'en_attente' => 'En attente', 'valide' => 'Validé', 'paye' => 'Payé', 'recupere' => 'Récupéré', 'annule' => 'Annulé', default => $order->status } }}</span>
                        </div>
                    </a>
                @empty
                    <div class="text-center py-16">
                        <p class="text-gray-400">Aucune commande pour le moment.</p>
                        <a href="{{ route('catalog.index') }}" class="btn btn-primary mt-4">Parcourir le catalogue</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        </div>
    </section>
@endsection
