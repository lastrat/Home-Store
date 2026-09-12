@extends('layouts.app')

@section('title', 'Mes Alertes et Intérêts - Home Store')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl sm:text-4xl font-bold mb-2">Mes Alertes et Intérêts</h1>
            <p class="text-gray-500">Produits que vous souhaitez être alerté quand disponibles ou que vous avez marqués comme intéressés</p>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-4">
                @forelse($alerts as $alert)
                    <div class="card p-6 flex items-center gap-6">
                        <div class="w-20 h-20 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                            <img src="{{ $alert->product->image1 ? asset('storage/' . $alert->product->image1) : 'https://via.placeholder.com/100?text=' . urlencode($alert->product->name) }}" alt="{{ $alert->product->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold mb-1">{{ $alert->product->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $alert->product->category->name }}</p>
                        </div>
                        <div>
                            @if($alert instanceof \App\Models\ProductInterest)
                                <span class="badge badge-love">Intéressé</span>
                            @else
                                <span class="badge badge-warning">Rupture de stock</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-gray-400">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                            </svg>
                        </div>
                        <p class="text-gray-400">Aucune alerte active pour le moment.</p>
                        <a href="{{ route('catalog.index') }}" class="btn btn-primary mt-4">Parcourir le catalogue</a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

