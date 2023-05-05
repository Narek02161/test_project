<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'token_type'   => $this->resource['tokenData']['token_type'],
            'access_token' => $this->resource['tokenData']['access_token'],
            'refresh_token' => $this->resource['tokenData']['refresh_token'],
            'expires_in'   => $this->resource['tokenData']['expires_in'],
            'user' => new UserResource($this->resource['user']),
        ];
    }
}
