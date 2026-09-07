@extends('layouts.app')

@section('title', 'Modifier: ' . $product->name . ' - Admin')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3 mb-2">
                <a href="{{ route('admin.products.index') }}" class="p-2 hover:bg-gray-100 rounded-xl transition-colors">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold">Modifier le produit</h1>
                    <p class="text-gray-500">Mettez à jour les informations de <span class="text-gold-600 font-semibold">{{ $product->name }}</span></p>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-8">
                        <div class="card p-8">
                            <h2 class="text-xl font-bold mb-6 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-gold-100 flex items-center justify-center">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gold-600">
                                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                        <line x1="7" y1="7" x2="7.01" y2="7"></line>
                                    </svg>
                                </div>
                                Informations générales
                            </h2>
                            <div class="space-y-5">
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Nom du produit <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" class="form-input" required value="{{ old('name', $product->name) }}" placeholder="Ex: Robe élégante noir">
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-semibold mb-2">Catégorie <span class="text-red-500">*</span></label>
                                        <select name="category_id" class="form-input" required>
                                            <option value="">Sélectionner...</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold mb-2">Prix (FCFA) <span class="text-red-500">*</span></label>
                                        <input type="number" name="price" step="0.01" class="form-input" required value="{{ old('price', $product->price) }}" placeholder="25000">
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-semibold mb-2">Stock <span class="text-red-500">*</span></label>
                                        <input type="number" name="stock" class="form-input" required value="{{ old('stock', $product->stock) }}" placeholder="0">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold mb-2">Badge</label>
                                        <select name="badge" class="form-input">
                                            <option value="">Aucun</option>
                                            <option value="nouveau" {{ old('badge', $product->badge) == 'nouveau' ? 'selected' : '' }}>Nouveau</option>
                                            <option value="coup_de_coeur" {{ old('badge', $product->badge) == 'coup_de_coeur' ? 'selected' : '' }}>Coup de cœur</option>
                                            <option value="bientot_epuise" {{ old('badge', $product->badge) == 'bientot_epuise' ? 'selected' : '' }}>Bientôt épuisé</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card p-8">
                            <h2 class="text-xl font-bold mb-6 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-blue-600">
                                        <line x1="4" y1="9" x2="20" y2="9"></line>
                                        <line x1="4" y1="15" x2="20" y2="15"></line>
                                        <line x1="10" y1="3" x2="8" y2="21"></line>
                                        <line x1="16" y1="3" x2="14" y2="21"></line>
                                    </svg>
                                </div>
                                Description
                            </h2>
                            <div class="space-y-5">
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Description</label>
                                    <textarea name="description" rows="4" class="form-input" placeholder="Décrivez le produit...">{{ old('description', $product->description) }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Caractéristiques</label>
                                    <textarea name="characteristics" rows="3" class="form-input" placeholder="Taille: M, Couleur: Noir, Matière: Coton...">{{ old('characteristics', $product->characteristics) }}</textarea>
                                    <p class="text-xs text-gray-500 mt-1.5">Utilisez des virgules pour séparer les attributs: Taille, Couleur, Matière, Entretien...</p>
                                </div>
                            </div>
                        </div>

                        <div class="card p-8">
                            <h2 class="text-xl font-bold mb-6 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-purple-600">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                        <polyline points="21 15 16 10 5 21"></polyline>
                                    </svg>
                                </div>
                                Médias
                            </h2>
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-semibold mb-3">Images du produit <span class="text-gray-400 font-normal">(max 3)</span></label>
                                    <div class="grid grid-cols-3 gap-4">
                                        @foreach(['image1', 'image2', 'image3'] as $imageField)
                                            <div class="image-upload-card" data-field="{{ $imageField }}">
                                                <div class="image-preview aspect-square rounded-xl bg-gray-100 overflow-hidden mb-2 relative group">
                                                    @if($product->$imageField)
                                                        <img src="{{ asset('storage/' . $product->$imageField) }}" alt="Preview" class="w-full h-full object-cover">
                                                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                                            <span class="text-white text-xs font-medium">Remplacer</span>
                                                        </div>
                                                    @else
                                                        <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                                                <line x1="12" y1="8" x2="12" y2="16"></line>
                                                                <line x1="8" y1="12" x2="16" y2="12"></line>
                                                            </svg>
                                                            <span class="text-xs mt-1">Ajouter</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <input type="file" name="{{ $imageField }}" accept="image/*" class="hidden" onchange="previewImage(this)">
                                                <button type="button" class="w-full text-xs text-center py-2 rounded-lg border border-gray-200 hover:border-gold-300 hover:text-gold-600 transition-colors" onclick="document.querySelector('[data-field={{ $imageField }}] input[type=file]').click()">
                                                    @if($product->$imageField)
                                                        Modifier l'image
                                                    @else
                                                        Ajouter une image
                                                    @endif
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold mb-2">URL Vidéo <span class="text-gray-400 font-normal">(optionnel)</span></label>
                                    <div class="relative">
                                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polygon points="23 7 16 12 23 17 23 7"></polygon>
                                            <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                                        </svg>
                                        <input type="url" name="video_url" class="form-input pl-10" value="{{ old('video_url', $product->video_url) }}" placeholder="https://youtube.com/watch?v=...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-1 space-y-6">
                        <div class="card p-6">
                            <h3 class="font-bold mb-4">Publication</h3>
                            <div class="space-y-4">
                                <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 hover:border-gold-300 cursor-pointer transition-colors">
                                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="w-4 h-4 rounded text-gold-600 focus:ring-gold-500">
                                    <div>
                                        <p class="text-sm font-semibold">Actif</p>
                                        <p class="text-xs text-gray-500">Visible dans le catalogue</p>
                                    </div>
                                </label>
                                <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 hover:border-gold-300 cursor-pointer transition-colors">
                                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="w-4 h-4 rounded text-gold-600 focus:ring-gold-500">
                                    <div>
                                        <p class="text-sm font-semibold">En vedette</p>
                                        <p class="text-xs text-gray-500">Afficher en page d'accueil</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="card p-6">
                            <h3 class="font-bold mb-4">Actions</h3>
                            <div class="space-y-3">
                                <button type="submit" class="btn btn-primary w-full">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    Enregistrer les modifications
                                </button>
                                <a href="{{ route('admin.products.index') }}" class="btn btn-ghost w-full">Annuler</a>
                            </div>
                        </div>

                        <div class="card p-6">
                            <h3 class="font-bold mb-3">Aperçu</h3>
                            <div class="aspect-video rounded-xl bg-gray-100 overflow-hidden mb-3">
                                <img src="{{ $product->image1 ? asset('storage/' . $product->image1) : 'https://via.placeholder.com/400x300?text=No+preview' }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            </div>
                            <p class="font-semibold text-sm">{{ $product->name }}</p>
                            <p class="text-gold-600 font-bold text-sm">{{ number_format($product->price, 0, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function previewImage(input) {
            const card = input.closest('.image-upload-card');
            const preview = card.querySelector('.image-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview" class="w-full h-full object-cover">';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
