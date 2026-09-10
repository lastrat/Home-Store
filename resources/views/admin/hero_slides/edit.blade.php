@extends('layouts.app')

@section('title', 'Modifier Slide Hero - Admin')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.hero_slides.index') }}" class="p-2 hover:bg-gray-100 rounded-xl transition-colors">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-600">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold">Modifier le Slide</h1>
                    <p class="text-gray-500">Modifiez les informations du slide hero</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="card p-8">
                @if($errors->any())
                    <div class="alert alert-error mb-6">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.hero_slides.update', $hero_slide) }}" class="space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-semibold mb-2">Titre <span class="text-brand-red">*</span></label>
                        <input type="text" name="title" class="form-input" required value="{{ old('title', $hero_slide->title) }}">
                        @error('title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">Sous-titre</label>
                        <textarea name="subtitle" rows="2" class="form-input" placeholder="Description courte affichée sous le titre">{{ old('subtitle', $hero_slide->subtitle) }}</textarea>
                        @error('subtitle')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">Image de fond <span class="text-brand-red">*</span></label>
                        <input type="file" name="background_image" class="form-input" accept="image/*">
                        @if($hero_slide->background_image)
                            <div class="mt-3">
                                <img src="{{ asset('storage/' . $hero_slide->background_image) }}" alt="{{ $hero_slide->title }}" class="w-full max-w-md h-48 object-cover rounded-xl">
                                <p class="text-xs text-gray-500 mt-1">Image actuelle. Téléchargez une nouvelle image pour la remplacer.</p>
                            </div>
                        @endif
                        @error('background_image')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold mb-2">Badge</label>
                            <input type="text" name="badge_text" class="form-input" value="{{ old('badge_text', $hero_slide->badge_text) }}" placeholder="Ex: Nouveau">
                            @error('badge_text')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Type</label>
                            <select name="type" class="form-input" required>
                                <option value="general" {{ old('type', $hero_slide->type) == 'general' ? 'selected' : '' }}>Général</option>
                                <option value="mode" {{ old('type', $hero_slide->type) == 'mode' ? 'selected' : '' }}>Mode</option>
                                <option value="decoration" {{ old('type', $hero_slide->type) == 'decoration' ? 'selected' : '' }}>Décoration</option>
                            </select>
                            @error('type')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold mb-2">Texte du bouton</label>
                            <input type="text" name="button_text" class="form-input" value="{{ old('button_text', $hero_slide->button_text) }}" placeholder="Ex: Découvrir">
                            @error('button_text')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Lien du bouton</label>
                            <input type="url" name="button_link" class="form-input" value="{{ old('button_link', $hero_slide->button_link) }}" placeholder="Ex: /catalogue">
                            @error('button_link')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold mb-2">Ordre d'affichage</label>
                            <input type="number" name="order" class="form-input" value="{{ old('order', $hero_slide->order) }}" min="0">
                            <p class="text-xs text-gray-500 mt-1">Les slides avec un ordre plus petit s'affichent en premier</p>
                            @error('order')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Statut</label>
                            <div class="flex items-center gap-3 mt-3">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $hero_slide->is_active ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-gold-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gold-500"></div>
                                    <span class="ml-3 text-sm font-medium text-gray-700">Actif</span>
                                </label>
                            </div>
                            @error('is_active')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex gap-4 pt-4">
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        <a href="{{ route('admin.hero_slides.index') }}" class="btn btn-ghost">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
