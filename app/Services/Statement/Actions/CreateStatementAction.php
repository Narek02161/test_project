<?php

namespace App\Services\Statement\Actions;

use App\Models\Statement\Statement;
use App\Models\UserStatement\UserStatement;
use App\Services\Statement\Dto\CreateStatementDTO;

class CreateStatementAction extends ParentStatementAction
{
    private Statement $statement;
    private CreateStatementDTO $dto;
    private UserStatement $userStatement;

    public function run(CreateStatementDTO $dto): Statement
    {
        $this->init($dto);

        $this->createStatementModel();

        $this->saveStatement();

        $this->createUserStatement();

        $this->saveUserStatement();

        return $this->statement;
    }

    private function init(CreateStatementDTO $dto): void
    {
        $this->dto = $dto;
    }

    private function createStatementModel(): void
    {
        $this->statement = Statement::create($this->dto);
    }

    private function createUserStatement(): void
    {
        $this->userStatement = UserStatement::create($this->dto->userId, $this->statement->id);
    }

    private function saveUserStatement(): void
    {
        $this->userStatementWriteRepository->save($this->userStatement);
    }

    private function saveStatement(): void
    {
        $this->statementWriteRepository->save($this->statement);
    }
}
