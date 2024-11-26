<?php

namespace App\Data;

use App\Enums\ActionTypeEnum;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Data;

class RegisterProductData extends Data
{
    public function __construct(
        public int $product_id,
        public float $quantity,
        public float $price,
        public float $selling_price,
        public ActionTypeEnum $action_type,
    ) {
    }
}
