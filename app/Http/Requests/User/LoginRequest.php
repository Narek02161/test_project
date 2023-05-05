<?php

namespace App\Http\Requests\User;

class LoginRequest extends ParentAuthRequest
{
    private const EMAIL = 'email';

    public function rules(): array
    {
        return [
            self::EMAIL => [
                'string',
                'required',
                'max:255',
            ],
        ];
    }

    public function getEmail(): string
    {
        return $this->get(self::EMAIL);
    }
}
