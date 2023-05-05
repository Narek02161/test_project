<?php

namespace Database\Mocks\Users;

abstract class UserBaseMockClass
{
    public UserDto $dto;

    public function toArray(): array
    {
        return $this->dto->toArray();
    }
}
