<?php

namespace App\Services\Dto;

use Spatie\DataTransferObject\DataTransferObject;

class PaginationParamsDto extends DataTransferObject
{
    public int $perPage;
    public int $page;
}
