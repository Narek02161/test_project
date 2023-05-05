<?php

namespace App\Services\Statement\Actions;

use App\Services\Statement\Dto\IndexStatementDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class IndexStatementAction extends ParentStatementAction
{
    public function run(IndexStatementDTO $dto): LengthAwarePaginator
    {
        return $this->statementReadRepository->index($dto);
    }
}
