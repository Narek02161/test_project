<?php

namespace App\Repositories\Read\Statement;

use App\Models\Statement\Statement;
use Illuminate\Database\Eloquent\Builder;
use App\Services\Statement\Dto\IndexStatementDTO;
use App\Exceptions\Statement\StatementNotFoundException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class StatementReadRepository implements StatementReadRepositoryInterface
{
    public function query(): Builder
    {
        return Statement::query();
    }

    public function index(IndexStatementDTO $dto, array $relations = []): LengthAwarePaginator
    {
        $query = $this->query();

        $query->with($relations);

        if ($dto->q) {
            $query->where(function (Builder $query) use ($dto) {
                $query->where('title', 'like', "%$dto->q%");
            });
        }

        foreach ($this->sorts ?? [] as $sort) {
            $query->orderBy($sort['value'], $sort['key']);
        }

        return $query->paginate(
            $dto->pagination->perPage,
            ['*'],
            'page',
            $dto->pagination->page
        );
    }

    /**
     * @throws StatementNotFoundException
     */
    public function getById(int $id, array $relations = []): Statement
    {
        $statement = $this->query()
            ->where('id', $id)
            ->with($relations)
            ->first();

        if (is_null($statement)) {
            throw new StatementNotFoundException();
        }

        return $statement;
    }
}
