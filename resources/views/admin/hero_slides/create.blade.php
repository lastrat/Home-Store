@extends('layouts.app')

@section('title', 'Nouveau Slide Hero - Admin')

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
                    <h1 class="text-3xl font-bold">Nouveau Slide Hero</h1>
                    <p class="text-gray-500">Ajoutez une nouvelle diapositive au slider de la page d'accueil</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="card p-8">
                <form method="POST" action="{{ route('admin.hero_slides.store') }}" class="space-y-6" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold mb-2">Titre <span class="text-brand-red">*</span></label>
                        <input type="text" name="title" class="form-input" required value="{{ old('title') }}" placeholder="Ex: Collection Été 2026">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">Sous-titre</label>
                        <textarea name="subtitle" rows="2" class="form-input" placeholder="Description courte affichée sous le titre">{{ old('subtitle') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">Image de fond <span class="text-brand-red">*</span></label>
                        <input type="file" name="background_image" class="form-input" required accept="image/*">
                        <p class="text-xs text-gray-500 mt-1">Format recommandé: 1920x1080px, JPG ou PNG</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold mb-2">Badge</label>
                            <input type="text" name="badge_text" class="form-input" value="{{ old('badge_text') }}" placeholder="Ex: Nouveau">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Type</label>
                            <select name="type" class="form-input" required>
                                <option value="general" {{ old('type') == 'general' ? 'selected' : '' }}>Général</option>
                                <option value="mode" {{ old('type') == 'mode' ? 'selected' : '' }}>Mode</option>
                                <option value="decoration" {{ old('type') == 'decoration' ? 'selected' : '' }}>Décoration</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold mb-2">Texte du bouton</label>
                            <input type="text" name="button_text" class="form-input" value="{{ old('button_text', 'Découvrir') }}" placeholder="Ex: Découvrir">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Lien du bouton</label>
                            <input type="url" name="button_link" class="form-input" value="{{ old('button_link') }}" placeholder="Ex: /catalogue">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold mb-2">Ordre d'affichage</label>
                            <input type="number" name="order" class="form-input" value="{{ old('order', 0) }}" min="0">
                            <p class="text-xs text-gray-500 mt-1">Les slides avec un ordre plus petit s'affichent en premier</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Statut</label>
                            <div class="flex items-center gap-3 mt-3">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="is_active" class="sr-only peer" checked>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-gold-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gold-500"></div>
                                    <span class="ml-3 text-sm font-medium text-gray-700">Actif</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-4 pt-4">
                        <button type="submit" class="btn btn-primary">Créer le slide</button>
                        <a href="{{ route('admin.hero_slides.index') }}" class="btn btn-ghost">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
