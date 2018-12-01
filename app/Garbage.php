<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Garbage extends Model
{
    protected $fillable = [
        'name', 'description', 'buy_price', 'sell_price',
    ];
}
