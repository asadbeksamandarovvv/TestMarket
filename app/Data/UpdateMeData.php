<?php

namespace App\Data;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\Validation\Confirmed;
use Spatie\LaravelData\Data;

class UpdateMeData extends Data
{
    public function __construct(
        public string $full_name,
        #[Confirmed]
        public ?string $password,
        public ?UploadedFile $image,
    ) {
    }
}
