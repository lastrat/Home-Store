@extends('layouts.app')

@section('title', 'Mon Panier - Home Store')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl sm:text-4xl font-bold mb-2">Mon Panier</h1>
            <p class="text-gray-500 cart-items-count">{{ $cart->items_count }} article(s) dans votre panier</p>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="alert alert-success max-w-4xl mx-auto">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error max-w-4xl mx-auto">{{ session('error') }}</div>
            @endif

            @if($cart->items->isEmpty())
                <div class="text-center py-20">
                    <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-gray-400">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold mb-2">Votre panier est vide</h2>
                    <p class="text-gray-500 mb-6">Découvrez notre catalogue et trouvez votre bonheur.</p>
                    <a href="{{ route('catalog.index') }}" class="btn btn-primary">Parcourir le catalogue</a>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-4">
                        @foreach($cart->items as $item)
                            <div class="card p-4 flex gap-4">
                                <div class="w-24 h-24 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                                    <img src="{{ $item->product->image1 ? asset('storage/' . $item->product->image1) : 'https://via.placeholder.com/200x200?text=' . urlencode($item->product->name) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <h3 class="font-semibold mb-1">{{ $item->product->name }}</h3>
                                            <p class="text-sm text-gray-500">{{ $item->product->category->name }}</p>
                                            @if($item->variant)
                                                <p class="text-xs text-gold-600 mt-1">
                                                    {{ $item->variant->size ? $item->variant->size . ' / ' : '' }}
                                                    {{ $item->variant->color ? $item->variant->color . ' / ' : '' }}
                                                    {{ $item->variant->material ? $item->variant->material : '' }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <form method="POST" action="{{ route('cart.update', $item) }}" class="flex items-center gap-2 cart-update-form" data-item-id="{{ $item->id }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->variant ? $item->variant->stock : $item->product->stock }}" class="form-input w-16 text-center text-sm py-1 cart-qty-input">
                                            </form>
                                            <form method="POST" action="{{ route('cart.remove', $item) }}" onsubmit="return confirm('Retirer ce produit ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-brand-red hover:bg-red-50 rounded-lg transition-colors">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    {{-- <div class="mt-2 text-right">
                                        <span class="text-sm font-semibold text-gray-700">Sous-total: </span>
                                        <span class="text-sm font-bold text-gold-600 cart-item-subtotal" data-item-id="{{ $item->id }}">
                                            {{ number_format($item->subtotal, 0, ',', ' ') }} FCFA
                                        </span>
                                    </div> --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <div class="card p-6 space-y-4 sticky top-28">
                            <h3 class="font-bold text-lg">Récapitulatif</h3>
                            {{-- <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Sous-total</span>
                                <span class="font-semibold cart-total-value">{{ number_format($cart->total, 0, ',', ' ') }} FCFA</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Livraison</span>
                                <span class="font-semibold text-green-600">Gratuite</span>
                            </div>
                            <div class="border-t border-gray-100 pt-4">
                                <div class="flex justify-between text-lg font-bold">
                                    <span>Total</span>
                                    <span class="text-gold-600 cart-total-value">{{ number_format($cart->total, 0, ',', ' ') }} FCFA</span>
                                </div>
                            </div> --}}
                            <a href="{{ route('checkout.index') }}" class="btn btn-primary w-full">Valider ma sélection</a>
                            <a href="{{ route('catalog.index') }}" class="btn btn-ghost w-full">Continuer mes achats</a>
                            <form method="POST" action="{{ route('cart.clear') }}" onsubmit="return confirm('Vider le panier ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-sm text-brand-red hover:text-brand-red/80 mt-2">Vider le panier</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

            document.querySelectorAll('.cart-qty-input').forEach(input => {
                input.addEventListener('change', function() {
                    const form = this.closest('.cart-update-form');
                    const itemId = form.dataset.itemId;
                    const quantity = parseInt(this.value) || 1;
                    const originalValue = this.value;

                    this.disabled = true;

                    const formData = new FormData();
                    formData.append('_token', csrfToken);
                    formData.append('_method', 'PUT');
                    formData.append('quantity', quantity);

                    fetch(`{{ url('/panier/item') }}/${itemId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        credentials: 'same-origin',
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const subtotalEl = document.querySelector(`.cart-item-subtotal[data-item-id="${itemId}"]`);
                            if (subtotalEl && data.item_subtotal !== undefined) {
                                subtotalEl.textContent = new Intl.NumberFormat('fr-FR').format(data.item_subtotal) + ' FCFA';
                            }
                            if (data.cart_total !== undefined) {
                                document.querySelectorAll('.cart-total-value').forEach(el => {
                                    el.textContent = new Intl.NumberFormat('fr-FR').format(data.cart_total) + ' FCFA';
                                });
                            }
                            if (data.items_count !== undefined) {
                                document.querySelectorAll('.cart-items-count').forEach(el => {
                                    el.textContent = data.items_count + ' article(s) dans votre panier';
                                });
                            }
                        } else {
                            this.value = originalValue;
                            alert(data.message || 'Erreur lors de la mise à jour.');
                        }
                    })
                    .catch(() => {
                        this.value = originalValue;
                        alert('Erreur lors de la mise à jour.');
                    })
                    .finally(() => {
                        this.disabled = false;
                    });
                });
            });
        });
    </script>
@endpush

