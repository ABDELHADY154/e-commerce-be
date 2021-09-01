<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientAddress extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'city',
        'building_no',
        "floor",
        "appartment_no",
        "region",
        "street_name",
        "client_id",
        "default"
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, "client_id");
    }
    public function  orders()
    {
        return $this->hasMany(Order::class);
    }
}
