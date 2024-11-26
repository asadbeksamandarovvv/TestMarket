<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasRoles;

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'name_ru',
        'price',
        'selling_price',
        'bar_code',
        'description',
        'description_ru',
        'is_active',
    ];

    protected array $cast = [
        'price'         => 'decimal:2',
        'selling_price' => 'decimal:2',
        'is_active'     => 'boolean',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function registerProducts()
    {
        return $this->BelongsTo(RegisterProduct::class);
    }
    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Attachment::class, 'attachment')
            ->withDefault([
                              'path_original' => 'images/no-image.png',
                              'path_1024'     => 'images/no-image.png',
                              'path_512'      => 'images/no-image.png',
                          ]);
    }

    public function like()
    {
        return $this->belongsToMany(User::class, 'liked_product', 'product_id', 'user_id');
    }

    public function discount(): HasOne
    {
        return $this->hasOne(DiscountProduct::class);
    }
}
