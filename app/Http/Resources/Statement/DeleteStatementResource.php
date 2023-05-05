<?php

namespace App\Http\Resources\Statement;

use Illuminate\Http\Resources\Json\JsonResource;

class DeleteStatementResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'success' => $this->resource ?? false,
        ];
    }
}
