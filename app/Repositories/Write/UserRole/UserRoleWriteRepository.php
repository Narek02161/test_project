<?php

namespace App\Repositories\Write\UserRole;

use App\Models\UserRole;
use App\Exceptions\SavingErrorException;
use Illuminate\Database\Eloquent\Builder;

class UserRoleWriteRepository implements UserRoleWriteRepositoryInterface
{
    private function query(): Builder
    {
        return UserRole::query();
    }

    /**
     * @throws SavingErrorException
     */
    public function saveRoles(array $roles): bool
    {
        if (!$this->query()->insert($roles)) {
            throw new SavingErrorException();
        }

        return true;
    }
}
