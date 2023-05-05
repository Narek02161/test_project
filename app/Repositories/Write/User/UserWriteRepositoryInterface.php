<?php

namespace App\Repositories\Write\User;

use App\Models\User;

interface UserWriteRepositoryInterface
{
    public function save(User $user): User;
    public function attachUserTeam(User $user, int $teamId, string $roleId): bool;
}
