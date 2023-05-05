<?php

namespace App\Exceptions\User;

use App\Exceptions\BusinessLogicException;

class OauthClientNotFoundException extends BusinessLogicException
{
    public function getStatus(): int
    {
        return self::UNKNOWN_ERROR;
    }

    public function getStatusMessage(): string
    {
        return 'Unknown error';
    }
}
