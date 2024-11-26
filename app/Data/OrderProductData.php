<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;

class OrderProductData extends Data
{
    public function __construct(
        #[Exists('products', 'id')]
        public int $product_id,
        public int $quantity,
    ) {
    }
}
