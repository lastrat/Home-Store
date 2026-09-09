@extends('layouts.app')

@section('title', 'Commande ' . $order->order_number . ' - Admin')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.orders.index') }}" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold">Commande {{ $order->order_number }}</h1>
                    <p class="text-gray-500">{{ $order->user->name }} - {{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="card p-8 mb-6">
                <h2 class="text-xl font-bold mb-6">Informations</h2>
                <div class="grid grid-cols-2 gap-4 text-sm mb-6">
                    <div><span class="text-gray-500">Client:</span> <strong>{{ $order->user->name }}</strong></div>
                    <div><span class="text-gray-500">Email:</span> <strong>{{ $order->user->email }}</strong></div>
                    <div><span class="text-gray-500">Téléphone:</span> <strong>{{ $order->user->phone }}</strong></div>
                    <div><span class="text-gray-500">Quartier:</span> <strong>{{ $order->user->neighborhood?->name ?? '-' }}</strong></div>
                    <div><span class="text-gray-500">Paiement:</span> <strong>{{ $order->payment_method }}</strong></div>
                    <div><span class="text-gray-500">Total:</span> <strong class="text-gold-600">{{ number_format($order->total, 0, ',', ' ') }} FCFA</strong></div>
                </div>

                <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" class="flex items-center gap-4">
                    @csrf
                    @method('PUT')
                    <select name="status" class="form-input flex-1">
                        <option value="en_attente" {{ $order->status == 'en_attente' ? 'selected' : '' }}>En attente</option>
                        <option value="valide" {{ $order->status == 'valide' ? 'selected' : '' }}>Validé</option>
                        <option value="paye" {{ $order->status == 'paye' ? 'selected' : '' }}>Payé</option>
                        <option value="recupere" {{ $order->status == 'recupere' ? 'selected' : '' }}>Récupéré</option>
                        <option value="annule" {{ $order->status == 'annule' ? 'selected' : '' }}>Annulé</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>

            <div class="card p-8">
                <h2 class="text-xl font-bold mb-6">Articles</h2>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0">
                                <img src="{{ $item->product->image1 ? asset('storage/' . $item->product->image1) : 'https://via.placeholder.com/50?text=' . urlencode($item->product_name) }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <p class="font-medium">{{ $item->product_name }}</p>
                                <p class="text-sm text-gray-500">x{{ $item->quantity }} × {{ number_format($item->product_price, 0, ',', ' ') }} FCFA</p>
                            </div>
                            <p class="font-semibold">{{ number_format($item->subtotal, 0, ',', ' ') }} FCFA</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

