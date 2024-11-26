<?php

namespace App\Enums;

use App\Traits\BaseEnum;

enum ActionTypeEnum: string
{
    use BaseEnum;

    case        INCOME = 'income';
    case        OUTCOME = 'outcome';
}
