<?php

namespace App\Http\Requests\User;

class RegisterRequest extends ParentAuthRequest
{
    private const EMAIL = 'email';
    private const LANGUAGE = 'language';
    private const DISPLAY_NAME = 'display_name';
    private const TELEGRAM_USERNAME = 'telegram_username';

    public function rules(): array
    {
        return array_merge(parent::rules(), [
            self::EMAIL => [
                'string',
                'required',
                'unique:users',
                'max:255',
            ],
            self::DISPLAY_NAME => [
                'nullable',
                'string',
                'between:2,255',
            ],
            self::TELEGRAM_USERNAME => [
                'string',
                'nullable',
            ],
            self::LANGUAGE => [
                'string',
                'nullable',
            ]
        ]);
    }

    public function getEmail(): string
    {
        return $this->get(self::EMAIL);
    }

    public function getDisplayName(): ?string
    {
        return $this->get(self::DISPLAY_NAME);
    }

    public function getTelegramUsername(): ?string
    {
        return $this->get(self::TELEGRAM_USERNAME);
    }

    public function getLanguage(): ?string
    {
        return $this->get(self::LANGUAGE);
    }
}
