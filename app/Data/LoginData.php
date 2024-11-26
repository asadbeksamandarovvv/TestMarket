<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Digits;
use Spatie\LaravelData\Data;

class LoginData extends Data
{
    public function __construct(
        #[Digits(12)]
        public string $phone_number,
    )
    {
    }
}
