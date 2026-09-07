@extends('layouts.app')

@section('title', 'Nouvelle catégorie - Admin')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold">Nouvelle Catégorie</h1>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="card p-8">
                <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold mb-2">Nom <span class="text-red-500">*</span></label>
                        <input type="text" name="name" class="form-input" required value="{{ old('name') }}" placeholder="Ex: Robes">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">Famille <span class="text-red-500">*</span></label>
                        <select name="family" class="form-input" required>
                            <option value="mode" {{ old('family') == 'mode' ? 'selected' : '' }}>Mode</option>
                            <option value="decoration" {{ old('family') == 'decoration' ? 'selected' : '' }}>Décoration</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">Catégorie parente</label>
                        <select name="parent_id" class="form-input">
                            <option value="">Aucune (catégorie principale)</option>
                            @foreach($parents as $parent)
                                <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-4">
                        <button type="submit" class="btn btn-primary">Créer</button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-ghost">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
