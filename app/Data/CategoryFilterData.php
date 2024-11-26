<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class CategoryFilterData extends Data
{
    public function __construct(
        public ?bool $with_products,
        public ?int $per_page = PER_PAGE,
        public ?bool $is_active = null,
    )
    {
    }
}
