<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class BannerFilterData extends Data
{
    public function __construct(
        public ?bool $is_active = null,
    ) {
    }
}
