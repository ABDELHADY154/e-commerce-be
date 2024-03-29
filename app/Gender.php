<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gender extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'gender_name', 'created_at'
    ];

    public function brands()
    {
        return $this->hasMany(Brand::class);
    }
}
