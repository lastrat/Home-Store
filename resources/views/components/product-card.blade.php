@props(['product'])

<div class="product-card group">
    <div class="image-wrap">
        <img src="{{ $product->image1 ? asset('storage/' . $product->image1) : 'https://via.placeholder.com/400x500?text=' . urlencode($product->name) }}" alt="{{ $product->name }}" loading="lazy">
        <div class="badge-wrap">
            @foreach($product->dynamic_badges as $badge)
                @if($badge === 'nouveau')
                    <span class="badge badge-new">Nouveau</span>
                @elseif($badge === 'coup_de_coeur')
                    <span class="badge badge-love">Coup de cœur</span>
                @elseif($badge === 'bientot_epuise')
                    <span class="badge badge-warning">Bientôt épuisé</span>
                @endif
            @endforeach
            @if($product->is_out_of_stock)
                <span class="badge badge-warning">Épuisé</span>
            @elseif($product->stock <= 3 && !in_array('bientot_epuise', $product->dynamic_badges))
                <span class="badge badge-warning">Plus que {{ $product->stock }}</span>
            @endif
        </div>
        <div class="actions">
            @if($product->stock > 0)
                <button class="cart-add-btn" data-product-id="{{ $product->id }}" title="Ajouter au panier">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                </button>
            @endif
            <button class="wishlist-toggle-btn {{ $product->wishlists->isNotEmpty() ? 'active' : '' }}" data-product-id="{{ $product->id }}" title="Coup de cœur">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="{{ $product->wishlists->isNotEmpty() ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
            </button>
            @if(auth()->check())
            <button class="like-btn" data-product-id="{{ $product->id }}" title="J'aime">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path>
                </svg>
            </button>
            @endif
            @if($product->is_out_of_stock && auth()->check())
                <button class="interest-btn" data-product-id="{{ $product->id }}" title="Être notifié">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                </button>
            @endif
        </div>
    </div>
        <div class="p-5">
            <p class="text-xs text-gold-600 font-medium uppercase tracking-wider mb-1">{{ $product->category->name ?? '' }}</p>
            <h3 class="font-semibold text-base mb-2 line-clamp-2">{{ $product->name }}</h3>
            <div class="flex items-center justify-between">
                @if($product->stock > 0)
                    <a href="{{ route('catalog.show', $product) }}" class="btn btn-primary btn-sm">Voir</a>
                @else
                    <button class="btn btn-outline btn-sm border-brand-red text-brand-red" disabled>Épuisé</button>
                @endif
            </div>
        </div>
</div>

