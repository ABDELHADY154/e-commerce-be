<?php

namespace App;

use CategorySeeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'brand', 'brand_image', 'brand_desc', 'gender_id'
    ];

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
