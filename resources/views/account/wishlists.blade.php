@extends('layouts.app')

@section('title', 'Mes Coups de Cœur - Home Store')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl sm:text-4xl font-bold mb-2">Mes Coups de Cœur</h1>
            <p class="text-gray-500">Vos articles préférés</p>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($wishlists as $wishlist)
                    @include('components.product-card', ['product' => $wishlist->product])
                @empty
                    <div class="col-span-full text-center py-16">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-gray-400">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-400">Vous n'avez pas encore de coups de cœur.</p>
                        <a href="{{ route('catalog.index') }}" class="btn btn-primary mt-4">Parcourir le catalogue</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $wishlists->links() }}
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.like-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const productId = this.dataset.productId;
                    fetch(`/produit/${productId}/like`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Not authenticated');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.liked) {
                            this.classList.add('text-gold-500');
                            this.querySelector('svg').setAttribute('fill', 'currentColor');
                        } else {
                            this.classList.remove('text-gold-500');
                            this.querySelector('svg').setAttribute('fill', 'none');
                        }
                    })
                    .catch(error => {
                        console.error('Like error:', error);
                        if (error.message === 'Not authenticated') {
                            alert('Veuillez vous connecter pour aimer ce produit.');
                        }
                    });
                });
            });

            document.querySelectorAll('.interest-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const productId = this.dataset.productId;
                    fetch(`/produit/${productId}/interest`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Not authenticated');
                        }
                        return response.json();
                    })
                    .then(data => {
                        alert(data.message);
                    })
                    .catch(error => {
                        console.error('Interest error:', error);
                        if (error.message === 'Not authenticated') {
                            alert('Veuillez vous connecter pour être notifié.');
                        }
                    });
                });
            });
        });
    </script>
@endpush

