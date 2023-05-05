<?php

namespace App\Services\Statement\Actions;

class DeleteStatementAction extends ParentStatementAction
{
    public function run(int $id): bool
    {
        return $this->userStatementWriteRepository->delete($id);
    }
}
