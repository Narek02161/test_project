<?php

namespace App\Exceptions\User;

use App\Exceptions\BusinessLogicException;

class UserSavingErrorException extends BusinessLogicException
{
    public function getStatus(): int
    {
        return BusinessLogicException::SAVING_ERROR;
    }

    public function getStatusMessage(): string
    {
        return 'Saving error';
    }
}
