<?php

namespace App\Services\User\Dto;

use App\Http\Requests\User\LoginRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class LoginDTO extends ParentAuthDTO
{
    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(LoginRequest $request): LoginDTO
    {
        return new self(
            email: $request->getEmail(),
            password: $request->getPassword(),
        );
    }
}
