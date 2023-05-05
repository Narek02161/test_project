<?php

namespace App\Http\Resources\Statement;

use Illuminate\Http\Resources\Json\JsonResource;

class IndexStatementResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'title' => $this->resource->title,
            'source_url' => $this->resource->source_url,
            'description' => $this->resource->description,
            'author_name' => $this->resource->author_name,
            'is_published' => $this->resource->is_published,
            'source_title' => $this->resource->source_title,
            'date_published' => $this->resource->date_published,
        ];
    }
}
