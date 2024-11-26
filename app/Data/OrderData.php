<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class OrderData extends Data
{
    public function __construct(
        #[DataCollectionOf(OrderProductData::class)]
        public DataCollection $products,
        public string $address,
        public float $lat,
        public float $lng,
        public ?string $comment,
    ) {
    }
}
