<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientMessage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'client_id', 'message'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
