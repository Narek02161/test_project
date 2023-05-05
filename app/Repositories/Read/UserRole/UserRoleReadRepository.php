<?php

namespace App\Repositories\Read\UserRole;

use App\Models\UserRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Exceptions\RoleDoesNotExist;

class UserRoleReadRepository implements UserRoleReadRepositoryInterface
{
    private function query(): Builder
    {
        return UserRole::query();
    }

    public function getByName(string $name, array $relations = []): UserRole
    {
        $role = $this->query()
            ->where('name', $name)
            ->with($relations)
            ->first();

        if (is_null($role)) {
            throw new RoleDoesNotExist();
        }

        return $role;
    }

    public function getAll(array $relations = []): Collection
    {
        return $this->query()->get();
    }
}
