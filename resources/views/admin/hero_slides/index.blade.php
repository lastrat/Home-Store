@extends('layouts.app')

@section('title', 'Slides Hero - Admin')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold">Slides Hero</h1>
                    <p class="text-gray-500">Gestion du slider de la page d'accueil</p>
                    <div class="w-12 h-1 bg-brand-red mt-3"></div>
                </div>
                <a href="{{ route('admin.hero_slides.create') }}" class="btn btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Nouveau slide
                </a>
            </div>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($slides as $slide)
                    <div class="card overflow-hidden">
                        <div class="relative h-64 bg-gray-100">
                            <img src="{{ asset('storage/' . $slide->background_image) }}" alt="{{ $slide->title }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold bg-gold-500 text-black">{{ ucfirst($slide->type) }}</span>
                                    @if($slide->badge_text)
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-brand-red text-white">{{ $slide->badge_text }}</span>
                                    @endif
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $slide->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                                        {{ $slide->is_active ? 'Actif' : 'Inactif' }}
                                    </span>
                                </div>
                                <h3 class="text-white font-bold text-xl">{{ $slide->title }}</h3>
                                @if($slide->subtitle)
                                    <p class="text-gray-300 text-sm mt-1">{{ $slide->subtitle }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="p-4 flex items-center justify-between">
                            <span class="text-sm text-gray-500">Ordre: {{ $slide->order }}</span>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.hero_slides.edit', $slide) }}" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-600">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.hero_slides.destroy', $slide) }}" onsubmit="return confirm('Supprimer ce slide ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 hover:bg-red-50 rounded-lg transition-colors">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-brand-red">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <p class="text-gray-400">Aucun slide pour le moment. Créez votre premier slide pour dynamiser la page d'accueil.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
