<?php

namespace App\Repositories\Read\UserStatement;

use App\Models\UserStatement\UserStatement;

interface UserStatementReadRepositoryInterface
{
    public function getByStatementId(int $statementId): UserStatement;
}
