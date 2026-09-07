@extends('layouts.app')

@section('title', 'Commandes - Admin')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold">Commandes</h1>
                    <p class="text-gray-500">Gestion des commandes</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="card mb-6">
                <form method="GET" action="{{ route('admin.orders.index') }}" class="flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-input pl-10" placeholder="Rechercher par n° ou client...">
                    </div>
                    <select name="status" class="form-input sm:w-56">
                        <option value="">Tous statuts</option>
                        <option value="en_attente" {{ request('status') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                        <option value="valide" {{ request('status') == 'valide' ? 'selected' : '' }}>Validé</option>
                        <option value="paye" {{ request('status') == 'paye' ? 'selected' : '' }}>Payé</option>
                        <option value="recupere" {{ request('status') == 'recupere' ? 'selected' : '' }}>Récupéré</option>
                        <option value="annule" {{ request('status') == 'annule' ? 'selected' : '' }}>Annulé</option>
                    </select>
                    <button type="submit" class="btn btn-primary whitespace-nowrap">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        Filtrer
                    </button>
                </form>
            </div>

            <div class="card overflow-hidden">
                <div class="flex items-center justify-between p-4 border-b border-gray-100">
                    <p class="text-sm text-gray-500">{{ $orders->total() }} commande(s)</p>
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

                <div id="admin-orders-table" class="overflow-x-auto">
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
                                    <td>
                                        <span class="badge badge-gold">{{ match($order->status) { 'en_attente' => 'En attente', 'valide' => 'Validé', 'paye' => 'Payé', 'recupere' => 'Récupéré', 'annule' => 'Annulé', default => $order->status } }}</span>
                                    </td>
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

                <div id="admin-orders-grid" class="hidden p-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        @forelse($orders as $order)
                            <a href="{{ route('admin.orders.show', $order) }}" class="card p-5 flex flex-col gap-3 hover:border-gold-300 border-2 border-transparent transition-all">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="font-mono text-xs font-bold text-gray-500 mb-1">Commande</p>
                                        <p class="font-mono font-bold text-sm">{{ $order->order_number }}</p>
                                    </div>
                                    <span class="badge badge-gold text-xs">{{ match($order->status) { 'en_attente' => 'En attente', 'valide' => 'Validé', 'paye' => 'Payé', 'recupere' => 'Récupéré', 'annule' => 'Annulé', default => $order->status } }}</span>
                                </div>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Client</span>
                                        <span class="font-medium">{{ $order->user->name }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Date</span>
                                        <span class="font-medium">{{ $order->created_at->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Total</span>
                                        <span class="font-bold text-gold-600">{{ number_format($order->total, 0, ',', ' ') }} FCFA</span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-full text-center py-12 text-gray-400">Aucune commande.</div>
                        @endforelse
                    </div>
                </div>

                <div class="p-4">
                    {{ $orders->links() }}
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
            const tableView = document.getElementById('admin-orders-table');
            const gridView = document.getElementById('admin-orders-grid');

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
