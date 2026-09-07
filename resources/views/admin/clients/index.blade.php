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
                <form method="GET" action="{{ route('admin.clients.index') }}" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-input flex-1" placeholder="Rechercher par nom, téléphone, email...">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </form>
            </div>

            <div class="card overflow-hidden">
                <div class="overflow-x-auto">
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
                <div class="p-4">
                    {{ $clients->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
