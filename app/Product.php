<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Overtrue\LaravelFavorite\Traits\Favoriteable;

class Product extends Model
{
    use SoftDeletes, Favoriteable;

    protected $fillable = [
        'name', 'desc', 'price', 'discount', 'quantity', 'category_id', 'total_price', 'sale'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_product')->withPivot('id', 'size_id', 'quantity');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')->withPivot('id', 'size_id', 'quantity');
    }
}
