<?php

namespace App\Http\Controllers\Statement;

use App\Http\Controllers\Controller;
use App\Services\Statement\Dto\DeleteStatementDTO;
use App\Services\Statement\Dto\IndexStatementDTO;
use App\Services\Statement\Dto\UpdateStatementDTO;
use App\Services\Statement\Dto\CreateStatementDTO;
use App\Http\Requests\Statement\IndexStatementRequest;
use App\Http\Requests\Statement\CreateStatementRequest;
use App\Http\Requests\Statement\DeleteStatementRequest;
use App\Http\Requests\Statement\UpdateStatementRequest;
use App\Http\Resources\Statement\IndexStatementResource;
use App\Http\Resources\Statement\UpdateStatementResource;
use App\Http\Resources\Statement\DeleteStatementResource;
use App\Services\Statement\Actions\IndexStatementAction;
use App\Services\Statement\Actions\UpdateStatementAction;
use App\Services\Statement\Actions\DeleteStatementAction;
use App\Services\Statement\Actions\CreateStatementAction;
use App\Http\Resources\Statement\CreateStatementResource;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StatementController extends Controller
{
    /**
     * @throws UnknownProperties
     */
    public function index(
        IndexStatementRequest $request,
        IndexStatementAction $indexStatementAction,
    ): AnonymousResourceCollection {
        $dto = IndexStatementDTO::fromRequest($request);

        $result = $indexStatementAction->run($dto);

        return IndexStatementResource::collection($result);
    }

    /**
     * @throws UnknownProperties
     */
    public function create(
        CreateStatementRequest $request,
        CreateStatementAction $createStatementAction,
    ): CreateStatementResource {
        $dto = CreateStatementDTO::fromRequest($request);

        $result = $createStatementAction->run($dto);

        return new CreateStatementResource($result);
    }

    /**
     * @throws UnknownProperties
     */
    public function update(
        UpdateStatementRequest $request,
        UpdateStatementAction $updateStatementAction,
    ): UpdateStatementResource {
        $dto = UpdateStatementDTO::fromRequest($request);

        $result = $updateStatementAction->run($dto);

        return new UpdateStatementResource($result);
    }

    /**
     * @throws UnknownProperties
     */
    public function delete(
        DeleteStatementRequest $request,
        DeleteStatementAction $deleteStatementAction,
    ): DeleteStatementResource {
        $dto = DeleteStatementDTO::fromRequest($request);

        $result = $deleteStatementAction->run($dto->id);

        return new DeleteStatementResource($result);
    }
}
