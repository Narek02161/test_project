<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'email' => $this->resource->email,
            'created_at' => $this->resource->created_at,
            'display_name' => $this->resource->display_name,
            'telegram_username' => $this->resource->telegram_username,
            'language' => $this->resource->language,
        ];
    }
}
