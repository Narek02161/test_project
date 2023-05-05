<?php

namespace Database\Mocks\Users;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UserDto extends DataTransferObject
{
    public ?int $id = null;
    public string $ip;
    public string $email;
    public string $password;
    public string $language;
    public string $display_name;
    public string $telegram_username;

    /**
     * @throws UnknownProperties
     */
    public static function createUser(array $config = []): self
    {
        return new self(
            id: $config['id'],
            ip: $config['ip'],
            email: $config['email'],
            password: $config['password'],
            language: $config['language'],
            display_name: $config['display_name'],
            telegram_username: $config['telegram_username'],
        );
    }
}
