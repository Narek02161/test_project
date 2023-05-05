<?php

namespace App\Enum\StatementPermission;

use App\Enum\EnumTrait;

enum StatementPermission: string
{
    use EnumTrait;

    case VIEW = 'access_statement_view';
    case SHARE = 'access_statement_share';
    case CREATE = 'access_statement_create';
    case UPDATE = 'access_statement_update';
    case DELETE = 'access_statement_delete';
}
