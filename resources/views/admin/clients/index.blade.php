@extends('layouts.app')

@section('title', 'Clients - Admin')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold">Clients</h1>
                    <p class="text-gray-500">Gestion de la clientèle</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="card mb-6">
                <form method="GET" action="{{ route('admin.clients.index') }}" class="flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-input pl-10" placeholder="Rechercher par nom, téléphone, email...">
                    </div>
                    <button type="submit" class="btn btn-primary whitespace-nowrap">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        Rechercher
                    </button>
                </form>
            </div>

            <div class="card overflow-hidden">
                <div class="flex items-center justify-between p-4 border-b border-gray-100">
                    <p class="text-sm text-gray-500">{{ $clients->total() }} client(s)</p>
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

                <div id="admin-clients-table" class="overflow-x-auto">
                    <table class="data-table">
                        <thead>
                            <tr><th>Client</th><th>Téléphone</th><th>Email</th><th>Quartier</th><th>Profession</th><th>Commandes</th><th>Actions</th></tr>
                        </thead>
                        <tbody>
                            @forelse($clients as $client)
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gold-400 to-gold-600 flex items-center justify-center text-black font-bold text-sm flex-shrink-0">
                                                {{ substr($client->name, 0, 1) }}
                                            </div>
                                            <span class="font-medium">{{ $client->name }}</span>
                                        </div>
                                    </td>
                                    <td class="text-sm">{{ $client->phone }}</td>
                                    <td class="text-sm">{{ $client->email }}</td>
                                    <td class="text-sm">{{ $client->neighborhood?->name ?? '-' }}</td>
                                    <td class="text-sm">{{ $client->profession ?? '-' }}</td>
                                    <td><span class="badge badge-gold">{{ $client->orders_count }}</span></td>
                                    <td>
                                        <a href="{{ route('admin.clients.show', $client) }}" class="btn btn-sm btn-outline">Voir</a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="text-center py-8 text-gray-400">Aucun client.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div id="admin-clients-grid" class="hidden p-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        @forelse($clients as $client)
                            <a href="{{ route('admin.clients.show', $client) }}" class="card p-5 flex flex-col items-center text-center gap-3 hover:border-gold-300 border-2 border-transparent transition-all">
                                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-gold-400 to-gold-600 flex items-center justify-center text-black font-bold text-xl flex-shrink-0">
                                    {{ substr($client->name, 0, 1) }}
                                </div>
                                <div class="flex-1 w-full">
                                    <h4 class="font-bold text-sm mb-1">{{ $client->name }}</h4>
                                    <p class="text-xs text-gray-500 mb-1">{{ $client->email }}</p>
                                    <p class="text-xs text-gray-500">{{ $client->phone }}</p>
                                </div>
                                <div class="flex items-center justify-between w-full pt-3 border-t border-gray-100 text-sm">
                                    <span class="text-gray-500">Commandes</span>
                                    <span class="badge badge-gold">{{ $client->orders_count }}</span>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-full text-center py-12 text-gray-400">Aucun client.</div>
                        @endforelse
                    </div>
                </div>

                <div class="p-4">
                    {{ $clients->links() }}
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
            const tableView = document.getElementById('admin-clients-table');
            const gridView = document.getElementById('admin-clients-grid');

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
