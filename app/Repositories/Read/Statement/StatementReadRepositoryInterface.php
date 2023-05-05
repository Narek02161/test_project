<?php

namespace App\Repositories\Read\Statement;

use App\Models\Statement\Statement;
use App\Services\Statement\Dto\IndexStatementDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface StatementReadRepositoryInterface
{
    public function index(IndexStatementDTO $dto, array $relations = []): LengthAwarePaginator;

    public function getById(int $id, array $relations = []): Statement;
}
