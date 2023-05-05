<?php

namespace App\Services\Statement\Dto;

use App\Http\Requests\Statement\CreateStatementRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class CreateStatementDTO extends ParentStatementDTO
{
    public string $title;
    public string $authorName;
    public string $datePublished;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(CreateStatementRequest $request): CreateStatementDTO
    {
        return new self(
            title: $request->getTitle(),
            userId: $request->getUserId(),
            sourceUrl: $request->getSourceUrl(),
            description: $request->getDescription(),
            authorName: $request->getAuthorName(),
            isPublished: $request->getIsPublished(),
            sourceTitle: $request->getSourceTitle(),
            datePublished: $request->getDatePublished(),
        );
    }
}
