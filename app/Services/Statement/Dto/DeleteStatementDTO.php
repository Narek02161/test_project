<?php

namespace App\Services\Statement\Dto;

use Spatie\DataTransferObject\DataTransferObject;
use App\Http\Requests\Statement\DeleteStatementRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class DeleteStatementDTO extends DataTransferObject
{
    public int $id;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(DeleteStatementRequest $request): DeleteStatementDTO
    {
        return new self(
            id: $request->getStatementId(),
        );
    }
}
