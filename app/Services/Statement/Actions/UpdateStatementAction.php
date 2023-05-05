<?php

namespace App\Services\Statement\Actions;

use App\Models\Statement\Statement;
use App\Services\Statement\Dto\UpdateStatementDTO;

class UpdateStatementAction extends ParentStatementAction
{
    public function run(UpdateStatementDTO $dto): Statement
    {
        $statement = $this->statementReadRepository->getById($dto->id);

        $statement->updateByUser($dto);

        $this->statementWriteRepository->save($statement);

        return $statement;
    }
}
