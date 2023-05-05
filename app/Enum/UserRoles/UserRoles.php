<?php

namespace App\Enum\UserRoles;

use App\Enum\EnumTrait;

enum UserRoles: string
{
    use EnumTrait;

    case ADMIN = 'admin';
    case CLIENT = 'client';
}
