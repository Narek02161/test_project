<?php

namespace App\Services\User\Dto;

use App\Http\Requests\User\RegisterRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class CreateUserDTO extends ParentAuthDTO
{
    public ?string $language;
    public ?string $displayName;
    public ?string $telegramUsername;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(RegisterRequest $request): CreateUserDTO
    {
        return new self(
            email: $request->getEmail(),
            password: $request->getPassword(),
            language: $request->getLanguage(),
            displayName: $request->getDisplayName(),
            telegramUsername: $request->getTelegramUsername(),
        );
    }
}
