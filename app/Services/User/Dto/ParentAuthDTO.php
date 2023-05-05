<?php

namespace App\Services\User\Dto;

use Spatie\DataTransferObject\DataTransferObject;

class ParentAuthDTO extends DataTransferObject
{
    public string $email;
    public string $password;
}
