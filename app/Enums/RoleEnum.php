<?php

namespace App\Enums;

use App\Traits\BaseEnum;

enum RoleEnum: string
{
    use BaseEnum;

    case        ADMIN       = 'admin';
    case        DISPATCHER  = 'dispatcher';
    case        MEMBER      = 'member';
    case    COURIER      = 'courier';
}

