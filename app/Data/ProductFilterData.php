<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class ProductFilterData extends Data
{
    public function __construct(
        public ?int $category_id = null,
        public ?string $search = null,
        public ?bool $liked = null,
        public ?bool $discount = null,
        public ?int $per_page = PER_PAGE,
        public ?bool $is_active = null,

    ) {
    }
}
