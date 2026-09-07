@extends('layouts.app')

@section('title', 'Modifier produit - Admin')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold">Modifier: {{ $product->name }}</h1>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="card p-8">
                <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-semibold mb-2">Nom du produit</label>
                        <input type="text" name="name" class="form-input" required value="{{ old('name', $product->name) }}">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold mb-2">Catégorie</label>
                            <select name="category_id" class="form-input" required>
                                <option value="">Sélectionner...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Prix (FCFA)</label>
                            <input type="number" name="price" step="0.01" class="form-input" required value="{{ old('price', $product->price) }}">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold mb-2">Stock</label>
                            <input type="number" name="stock" class="form-input" required value="{{ old('stock', $product->stock) }}">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Badge</label>
                            <select name="badge" class="form-input">
                                <option value="">Aucun</option>
                                <option value="nouveau" {{ old('badge', $product->badge) == 'nouveau' ? 'selected' : '' }}>Nouveau</option>
                                <option value="coup_de_coeur" {{ old('badge', $product->badge) == 'coup_de_coeur' ? 'selected' : '' }}>Coup de cœur</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">Description</label>
                        <textarea name="description" rows="3" class="form-input">{{ old('description', $product->description) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">Caractéristiques</label>
                        <textarea name="characteristics" rows="3" class="form-input">{{ old('characteristics', $product->characteristics) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">Images (laisser vide pour conserver)</label>
                        <input type="file" name="image1" class="form-input" accept="image/*">
                        <input type="file" name="image2" class="form-input mt-2" accept="image/*">
                        <input type="file" name="image3" class="form-input mt-2" accept="image/*">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">URL Vidéo</label>
                        <input type="url" name="video_url" class="form-input" value="{{ old('video_url', $product->video_url) }}">
                    </div>
                    <div class="flex gap-6">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="rounded">
                            <span class="text-sm">Actif</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="rounded">
                            <span class="text-sm">En vedette</span>
                        </label>
                    </div>
                    <div class="flex gap-4">
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
