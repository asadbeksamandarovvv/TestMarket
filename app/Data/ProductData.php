<?php

namespace App\Data;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

class ProductData extends Data
{
    public function __construct(
        public string $name,
        public string $name_ru,
        public string $description,
        public string $description_ru,
        public ?float $price,
        public ?float $selling_price,
        public int $category_id,
        public int $brand_id,
        public ?int $quantity,
        public ?UploadedFile $image,

    ) {
    }
}
