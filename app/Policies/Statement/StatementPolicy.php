<?php

namespace App\Policies\Statement;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Exceptions\Statement\AccessDeniedStatementException;
use App\Repositories\Read\Statement\StatementReadRepositoryInterface;

class StatementPolicy
{
    use HandlesAuthorization;

    public function __construct(
        private readonly StatementReadRepositoryInterface $statementReadRepository,
    ) {
    }

    /**
     * @throws AccessDeniedStatementException
     */
    public function update(User $user, int $id): bool
    {
        $statement = $this->statementReadRepository->getById($id);

        if ($statement->owner_id !== $user->id) {
            throw new AccessDeniedStatementException();
        }

        return true;
    }

    /**
     * @throws AccessDeniedStatementException
     */
    public function delete(User $user, int $id): bool
    {
        $statement = $this->statementReadRepository->getById($id);

        if ($statement->owner_id !== $user->id) {
            throw new AccessDeniedStatementException();
        }

        return true;
    }
}
