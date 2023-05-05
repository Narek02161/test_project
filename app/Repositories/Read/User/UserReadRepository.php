<?php

namespace App\Repositories\Read\User;

use App\Exceptions\User\UserNotFoundException;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserReadRepository implements UserReadRepositoryInterface
{
    private function query(): Builder
    {
        return User::query();
    }

    /**
     * @throws UserNotFoundException
     */
    public function getByEmail(string $username, array $relations = []): User
    {
        $user = $this->query()
            ->where('email', $username)
            ->with($relations)
            ->first();

        if (is_null($user)) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
