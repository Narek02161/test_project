<?php

namespace App\Exceptions\Statement;

use App\Exceptions\BusinessLogicException;

class StatementNotFoundException extends BusinessLogicException
{

    public function getStatus(): int
    {
        return BusinessLogicException::STATEMENT_NOT_FOUND;
    }

    public function getStatusMessage(): string
    {
        return 'Statement is not found';
    }
}
