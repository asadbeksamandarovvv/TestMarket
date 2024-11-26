<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class CourierLoginData extends Data
{
    public function __construct(
        public string $phone_number,
        public string $password,
    )
    {
    }
}
