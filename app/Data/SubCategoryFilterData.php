<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class SubCategoryFilterData extends Data
{
    public function __construct(
        public ?int $parent_id,
        public ?bool $with_products,
        public ?bool $is_active = null,
    )
    {
    }
}
