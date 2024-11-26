<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    protected $fillable = [
        'name',
        'price',
        'delivery_time',
        'free_min_total_price',
    ];
    protected $casts    = [
        'price'                => 'decimal:2',
        'free_min_total_price' => 'decimal:2',
    ];
}
