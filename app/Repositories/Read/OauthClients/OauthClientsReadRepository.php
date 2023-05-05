<?php

namespace App\Repositories\Read\OauthClients;

use Laravel\Passport\Client;
use Illuminate\Database\Eloquent\Builder;
use App\Exceptions\User\OauthClientNotFoundException;

class OauthClientsReadRepository implements OauthClientsReadRepositoryInterface
{
    public function query(): Builder
    {
        return Client::query();
    }

    /**
     * @throws OauthClientNotFoundException
     */
    public function getById(int $id): Client
    {
        $client = $this->query()
            ->where('id', $id)
            ->first();

        if (is_null($client)) {
            throw new OauthClientNotFoundException();
        }

        return $client;
    }
}
