<?php

namespace App\Services\Statement\Actions;

use App\Repositories\Read\Statement\StatementReadRepositoryInterface;
use App\Repositories\Write\Statement\StatementWriteRepositoryInterface;
use App\Repositories\Write\UserStatement\UserStatementWriteRepositoryInterface;

class ParentStatementAction
{
    public function __construct(
        protected StatementReadRepositoryInterface $statementReadRepository,
        protected StatementWriteRepositoryInterface $statementWriteRepository,
        protected UserStatementWriteRepositoryInterface $userStatementWriteRepository,
    ) {
    }
}
