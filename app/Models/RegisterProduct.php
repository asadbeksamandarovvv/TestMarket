<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use App\Enums\ActionTypeEnum;

class RegisterProduct extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'price',
        'selling_price',
        'action_type',
    ];

    protected array $cast = [
        'price'         => 'decimal:2',
        'selling_price' => 'decimal:2',
        'action_type'   => ActionTypeEnum::class,
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
