<?php

namespace App\Repositories\Write\Statement;

use App\Models\Statement\Statement;

interface StatementWriteRepositoryInterface
{
    public function save(Statement $statement);

    public function update(int $statementId, array $fields = []);
}
