<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    protected $fillable = ['product_id', 'size', 'color', 'material', 'sku', 'stock', 'price_adjustment'];

    protected $casts = [
        'stock' => 'integer',
        'price_adjustment' => 'decimal:2',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getIsOutOfStockAttribute(): bool
    {
        return $this->stock <= 0;
    }
}
