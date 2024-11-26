<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class DiscountProductData extends Data
{
    public function __construct(
      public int $product_id,
        public float $discount_price,
        public float $percentage,
        public float $start_date,
        public float $end_date
    ) {}
}
