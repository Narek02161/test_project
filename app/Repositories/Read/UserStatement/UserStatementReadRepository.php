<?php

namespace App\Repositories\Read\UserStatement;

use Illuminate\Database\Eloquent\Builder;
use App\Models\UserStatement\UserStatement;
use App\Exceptions\Statement\StatementNotFoundException;

class UserStatementReadRepository implements UserStatementReadRepositoryInterface
{
    private function query(): Builder
    {
        return UserStatement::query();
    }

    /**
     * @throws StatementNotFoundException
     */
    public function getByStatementId(int $statementId): UserStatement
    {
        $userStatement = $this->query()
            ->where('statement_id', $statementId)
            ->first();

        if (is_null($userStatement)) {
            throw new StatementNotFoundException();
        }

        return $userStatement;
    }
}
