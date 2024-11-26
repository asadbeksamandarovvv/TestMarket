<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class DiscountProduct extends Model
{
    protected $fillable = [
        'product_id',
        'price',
        'discount_price',
        'percentage',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'start_date'     => 'datetime',
        'end_date'       => 'datetime',
        'price'          => 'decimal:2',
        'discount_price' => 'decimal:2',
        'is_active'      => 'boolean',

    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Attachment::class, 'attachment');
    }
}
