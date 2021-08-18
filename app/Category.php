<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['category', 'brand_id'];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
