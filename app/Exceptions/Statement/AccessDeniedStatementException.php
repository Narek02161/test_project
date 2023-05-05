<?php

namespace App\Exceptions\Statement;

use App\Exceptions\BusinessLogicException;

class AccessDeniedStatementException extends BusinessLogicException
{

    public function getStatus(): int
    {
        return BusinessLogicException::ACCESS_DENIED;
    }

    public function getStatusMessage(): string
    {
        return 'Access denied for modifying statement';
    }
}
