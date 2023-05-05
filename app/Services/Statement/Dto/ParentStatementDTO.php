<?php

namespace App\Services\Statement\Dto;

use Spatie\DataTransferObject\DataTransferObject;

class ParentStatementDTO extends DataTransferObject
{
    public ?int $userId;
    public ?bool $isPublished;
    public ?string $sourceUrl;
    public ?string $description;
    public ?string $sourceTitle;
}
