<?php

namespace App\Repositories\Write\Statement;

use App\Models\Statement\Statement;
use Illuminate\Database\Eloquent\Builder;
use App\Exceptions\Statement\StatementSavingErrorException;

class StatementWriteRepository implements StatementWriteRepositoryInterface
{
    public function query(): Builder
    {
        return Statement::query();
    }

    /**
     * @throws StatementSavingErrorException
     */
    public function save(Statement $statement): Statement
    {
        if (!$statement->save()) {
            throw new StatementSavingErrorException();
        }

        return $statement;
    }

    public function update(int $statementId, array $fields = []): bool
    {
        return $this->query()
            ->where('id', $statementId)
            ->update($fields);
    }
}
