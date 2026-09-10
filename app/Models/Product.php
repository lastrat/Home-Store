<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'characteristics',
        'price', 'stock', 'image1', 'image2', 'image3', 'video_url',
        'badge', 'is_active', 'is_featured', 'size', 'color', 'material'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    public function stockAlerts(): HasMany
    {
        return $this->hasMany(StockAlert::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function getImagesAttribute(): array
    {
        return array_filter([$this->image1, $this->image2, $this->image3]);
    }

    public function getIsOutOfStockAttribute(): bool
    {
        return $this->stock <= 0 && $this->variants()->where('stock', '>', 0)->doesntExist();
    }

    public function getIsNewAttribute(): bool
    {
        return $this->created_at->greaterThan(now()->subMonth());
    }

    public function getIsLowStockAttribute(): bool
    {
        if ($this->stock > 0 && $this->stock <= 3) {
            return true;
        }

        return $this->variants()->where('stock', '>', 0)->where('stock', '<=', 3)->exists();
    }

    public function getIsFavoriteAttribute(): bool
    {
        if (auth()->check()) {
            return $this->wishlists()->where('user_id', auth()->id())->exists();
        }

        return false;
    }

    public function getDynamicBadgeAttribute(): ?string
    {
        if ($this->isNew) {
            return 'nouveau';
        }

        if ($this->isLowStock) {
            return 'bientot_epuise';
        }

        if ($this->isFavorite) {
            return 'coup_de_coeur';
        }

        return $this->badge;
    }
}
