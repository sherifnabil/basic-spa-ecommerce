<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'sku',
    ];

    protected $appends = ['in_cart'];

    protected function getInCartAttribute()
    {
        return !auth()->check() ? 0 : auth()
        ->user()
        ->carts
        ->where(
            'product_id',
            $this->attributes['id']
        )
        ->count();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Category::class,
            table: 'category_products'
        )->withTimestamps();
    }

    public function carts(): HasMany
    {
        return $this->hasMany(
            related: Cart::class
        );
    }
}
