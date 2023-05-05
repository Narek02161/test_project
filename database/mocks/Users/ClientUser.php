<?php

namespace Database\Mocks\Users;

use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class ClientUser extends UserBaseMockClass
{
    /**
     * @throws UnknownProperties
     */
    public function __construct($config = [])
    {
        $data = array_merge([
            'email'    => 'clientuser@gmail.com',
            'password'    => '123456',
            'display_name' => 'Client User',
        ], $config);

        $this->dto = new UserDto($data);
    }
}
