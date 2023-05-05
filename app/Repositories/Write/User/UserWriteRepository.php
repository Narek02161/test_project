<?php

namespace App\Repositories\Write\User;

use App\Models\User;
use App\Exceptions\User\UserSavingErrorException;

class UserWriteRepository implements UserWriteRepositoryInterface
{
    /**
     * @throws UserSavingErrorException
     */
    public function save(User $user): User
    {
        if (!$user->save()) {
            throw new UserSavingErrorException();
        }

        return $user;
    }

    public function attachUserTeam(User $user, int $teamId, string $roleId): bool
    {
        $user->team()->attach(
            $teamId,
            ['role_id' => $roleId]
        );

        return true;
    }
}
