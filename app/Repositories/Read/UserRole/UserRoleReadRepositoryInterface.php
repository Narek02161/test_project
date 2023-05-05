<?php

namespace App\Repositories\Read\UserRole;

use App\Models\UserRole;
use Illuminate\Database\Eloquent\Collection;

interface UserRoleReadRepositoryInterface
{
    public function getByName(string $name, array $relations = []): UserRole;
    public function getAll(array $relations = []): Collection;
}
