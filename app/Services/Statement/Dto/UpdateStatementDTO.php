<?php

namespace App\Services\Statement\Dto;

use App\Http\Requests\Statement\UpdateStatementRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UpdateStatementDTO extends ParentStatementDTO
{
    public int $id;
    public string $title;
    public string $authorName;
    public string $datePublished;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(UpdateStatementRequest $request): UpdateStatementDTO
    {
        return new self(
            title: $request->getTitle(),
            id: $request->getStatementId(),
            sourceUrl: $request->getSourceUrl(),
            authorName: $request->getAuthorName(),
            description: $request->getDescription(),
            isPublished: $request->getIsPublished(),
            sourceTitle: $request->getSourceTitle(),
            datePublished: $request->getDatePublished(),
        );
    }
}
