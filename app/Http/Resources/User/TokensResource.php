<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class TokensResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'token_type'   => $this->resource['token_type'],
            'access_token' => $this->resource['access_token'],
            'refresh_token' => $this->resource['refresh_token'],
            'expires_in'   => $this->resource['expires_in'],
        ];
    }
}
