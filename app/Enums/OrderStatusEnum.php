<?php

namespace App\Enums;

use App\Traits\BaseEnum;

enum OrderStatusEnum: string
{
    use BaseEnum;

    case        NEW = 'new';
    case        ACCEPTED = 'accepted';
    case        DELIVERY = 'delivery';
    case        DONE = 'done';
    case        CANCELED = 'canceled';
}
