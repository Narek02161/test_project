<?php

namespace App\Repositories\Read\OauthClients;

use Laravel\Passport\Client;

interface OauthClientsReadRepositoryInterface
{
    public function getById(int $id): Client;
}
