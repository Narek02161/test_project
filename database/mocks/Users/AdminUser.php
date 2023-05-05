<?php

namespace Database\Mocks\Users;

use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class AdminUser extends UserBaseMockClass
{
    /**
     * @throws UnknownProperties
     */
    public function __construct($config = [])
    {
        $data = array_merge([
            'email'    => 'adminuser@gmail.com',
            'password'    => '123456',
            'display_name' => 'Admin User',
        ], $config);

        $this->dto = UserDto::createUser($data);
    }
}
