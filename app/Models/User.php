<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'birthdate',
        'profession',
        'city_id',
        'neighborhood_id',
        'phone_verified_at',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'birthdate' => 'date',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];

    public function neighborhood(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Neighborhood::class);
    }

    public function cart(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function wishlists(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    public function stockAlerts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(StockAlert::class);
    }

    public function productInterests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductInterest::class);
    }

    public function productLikes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductLike::class);
    }

    public function productViews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductView::class);
    }

    public function getAgeAttribute(): ?int
    {
        return $this->birthdate ? $this->birthdate->age : null;
    }
}
