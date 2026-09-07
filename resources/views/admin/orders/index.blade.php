@extends('layouts.app')

@section('title', 'Commandes - Admin')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold">Commandes</h1>
            <p class="text-gray-500">Gestion des commandes</p>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="card mb-6">
                <form method="GET" action="{{ route('admin.orders.index') }}" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-input flex-1" placeholder="Rechercher par n° ou client...">
                    <select name="status" class="form-input">
                        <option value="">Tous statuts</option>
                        <option value="en_attente" {{ request('status') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                        <option value="valide" {{ request('status') == 'valide' ? 'selected' : '' }}>Validé</option>
                        <option value="paye" {{ request('status') == 'paye' ? 'selected' : '' }}>Payé</option>
                        <option value="recupere" {{ request('status') == 'recupere' ? 'selected' : '' }}>Récupéré</option>
                        <option value="annule" {{ request('status') == 'annule' ? 'selected' : '' }}>Annulé</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Filtrer</button>
                </form>
            </div>

            <div class="card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="data-table">
                        <thead>
                            <tr><th>N° Commande</th><th>Client</th><th>Date</th><th>Total</th><th>Statut</th><th>Actions</th></tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td class="font-mono text-sm font-bold">{{ $order->order_number }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td class="text-sm">{{ $order->created_at->format('d/m/Y') }}</td>
                                    <td class="font-semibold">{{ number_format($order->total, 0, ',', ' ') }} FCFA</td>
                                    <td><span class="badge badge-gold">{{ $order->status }}</span></td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline">Voir</a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center py-8 text-gray-400">Aucune commande.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-4">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
