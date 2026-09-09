@extends('layouts.app')

@section('title', 'Notre Boutique - Home Store')

@section('content')
    <section class="pt-32 pb-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <span class="text-brand-red font-semibold text-sm uppercase tracking-wider">In progress</span>
                <h1 class="text-4xl sm:text-5xl font-bold mt-2 mb-4 text-gray-900">Notre Boutique</h1>
                <div class="w-16 h-1 bg-brand-red mx-auto mb-6"></div>
                <p class="text-xl text-gray-600 leading-relaxed">Découvrez notre showroom et notre univers en images.</p>
            </div>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach(['01.png', '02.png', '03.png', '04.png', '05.png', '06.png', '07.png', '08.png', 'A2.png'] as $image)
                    <div class="group relative overflow-hidden rounded-2xl bg-white shadow-sm hover:shadow-xl transition-all duration-500 aspect-[4/3]">
                        <img src="{{ asset('boutiques/' . $image) }}" alt="Boutique Home Store" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
