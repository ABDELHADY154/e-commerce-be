<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

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
}