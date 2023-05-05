<?php

namespace App\Exceptions\Statement;

use App\Exceptions\BusinessLogicException;

class StatementSavingErrorException extends BusinessLogicException
{
    public function getStatus(): int
    {
        return BusinessLogicException::SAVING_ERROR;
    }

    public function getStatusMessage(): string
    {
        return 'Error when saving statement';
    }
}
