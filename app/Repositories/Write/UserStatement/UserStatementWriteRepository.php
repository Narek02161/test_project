<?php

namespace App\Repositories\Write\UserStatement;

use App\Models\Statement\Statement;
use App\Exceptions\SavingErrorException;
use Illuminate\Database\Eloquent\Builder;
use App\Models\UserStatement\UserStatement;

class UserStatementWriteRepository implements UserStatementWriteRepositoryInterface
{

    private function query(): Builder
    {
        return Statement::query();
    }

    /**
     * @throws SavingErrorException
     */
    public function save(UserStatement $statement): bool
    {
        if (!$statement->save()) {
            throw new SavingErrorException();
        }

        return true;
    }

    public function delete(int $id): bool
    {
        return $this->query()->where('id', $id)->delete();
    }
}
