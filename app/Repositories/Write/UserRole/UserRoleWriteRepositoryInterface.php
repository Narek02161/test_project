<?php

namespace App\Repositories\Write\UserRole;

interface UserRoleWriteRepositoryInterface
{
    public function saveRoles(array $roles): bool;
}
