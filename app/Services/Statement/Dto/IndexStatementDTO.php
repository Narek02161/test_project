<?php

namespace App\Services\Statement\Dto;

use App\Services\Dto\PaginationParamsDto;
use Spatie\DataTransferObject\DataTransferObject;
use App\Http\Requests\Statement\IndexStatementRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class IndexStatementDTO extends DataTransferObject
{
    public ?string $q;
    public ?array $sorts;
    public PaginationParamsDto $pagination;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(IndexStatementRequest $request): IndexStatementDTO
    {
        return new self(
            q: $request->getQ(),
            sorts: $request->getSort(),
            pagination: new PaginationParamsDto(
                page: $request->getPage(),
                perPage: $request->getPerPage(),
            ),
        );
    }
}
