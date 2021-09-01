<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_num', 'client_id', 'address_id', 'status', 'delivery', 'price', 'total_price'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function address()
    {
        return $this->belongsTo(ClientAddress::class, 'address_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot('id', 'size_id', 'quantity');
    }
}
