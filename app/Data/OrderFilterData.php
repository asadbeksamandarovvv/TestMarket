<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class OrderFilterData extends Data
{
    public function __construct(
        public ?bool $my_orders = null,
        public ?array $status = null,
    )
    {
    }
}
