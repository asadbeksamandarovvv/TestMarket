<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'branch_id',
        'tariff_id',
        'client_id',
        'courier_id',
        'total_price',
        'status',
        'comment',
        'address',
        'lat',
        'lng',
        'accepted_at',
        'delivered_at',
        'canceled_at',
    ];

    protected array $cast = [
        'total_price'  => 'decimal:2',
        'lat'          => 'decimal:3',
        'lng'          => 'decimal:3',
        'status'       => OrderStatusEnum::class,
        'accepted_at'  => 'datetime',
        'delivered_at' => 'datetime',
        'canceled_at'  => 'datetime',
    ];

    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function courier(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tariff(): BelongsTo
    {
        return $this->belongsTo(Tariff::class);
    }
}
