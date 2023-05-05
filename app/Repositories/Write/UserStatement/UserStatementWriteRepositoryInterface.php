<?php

namespace App\Repositories\Write\UserStatement;

use App\Models\UserStatement\UserStatement;

interface UserStatementWriteRepositoryInterface
{
    public function delete(int $id): bool;

    public function save(UserStatement $statement): bool;
}
