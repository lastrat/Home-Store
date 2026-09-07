@extends('layouts.app')

@section('title', 'Catégories - Admin')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold">Catégories</h1>
                    <p class="text-gray-500">Gestion des familles et sous-catégories</p>
                </div>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Nouvelle catégorie
                </a>
            </div>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($categories as $family)
                    <div class="card overflow-hidden">
                        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-gold-50 to-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="font-bold text-lg">{{ $family->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $family->products()->count() }} produits</p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.categories.edit', $family) }}" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-600">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $family) }}" onsubmit="return confirm('Supprimer cette catégorie ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 hover:bg-red-50 rounded-lg transition-colors">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-red-500">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                @forelse($family->children as $child)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                                        <div>
                                            <p class="font-medium text-sm">{{ $child->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $child->products()->count() }} produits</p>
                                        </div>
                                        <div class="flex gap-1">
                                            <a href="{{ route('admin.categories.edit', $child) }}" class="p-2 hover:bg-gray-200 rounded-lg transition-colors">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-600">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                </svg>
                                            </a>
                                            <form method="POST" action="{{ route('admin.categories.destroy', $child) }}" onsubmit="return confirm('Supprimer cette sous-catégorie ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 hover:bg-red-50 rounded-lg transition-colors">
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-red-500">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-400 text-center py-4">Aucune sous-catégorie</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
