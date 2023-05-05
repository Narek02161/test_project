<?php

namespace App\Services\User\Actions;

use App\Exceptions\User\OauthClientNotFoundException;
use App\Models\User;
use App\Repositories\Read\OauthClients\OauthClientsReadRepositoryInterface;
use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Repositories\Read\UserRole\UserRoleReadRepositoryInterface;
use App\Repositories\Write\Team\TeamWriteRepositoryInterface;
use App\Repositories\Write\User\UserWriteRepositoryInterface;
use App\Services\User\Dto\CreateUserDTO;
use App\Services\User\Dto\LoginDTO;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Config;
use Laravel\Passport\Client;
use Laravel\Passport\Exceptions\OAuthServerException;
use Laravel\Passport\Http\Controllers\HandlesOAuthErrors;
use League\OAuth2\Server\AuthorizationServer;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response as Psr7Response;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

class ParentAuthAction
{
    use HandlesOAuthErrors;

    protected User $user;
    protected array $tokenData;
    protected readonly Client $client;
    protected CreateUserDTO|LoginDTO $dto;
    protected ServerRequestInterface $serverRequest;

    public function __construct(
        protected readonly AuthorizationServer $server,
        protected readonly UserReadRepositoryInterface $userReadRepository,
        protected readonly UserWriteRepositoryInterface $userWriteRepository,
        protected readonly TeamWriteRepositoryInterface $teamWriteRepository,
        protected readonly UserRoleReadRepositoryInterface $userRoleReadRepository,
        protected readonly OauthClientsReadRepositoryInterface $oauthClientsReadRepository,
    ) {
    }

    protected function createServerRequest(): void
    {
        $this->serverRequest = (new PsrHttpFactory(
            new Psr17Factory(),
            new Psr17Factory(),
            new Psr17Factory(),
            new Psr17Factory()
        ))->createRequest(request());
    }

    protected function getPassportCredentials(): void
    {
        $oClientId = Config::get('passport.personal_access_client.id');

        $this->client = $this->oauthClientsReadRepository->getById($oClientId);
    }

    /**
     * @throws OauthClientNotFoundException
     */
    protected function withParsedBodyToServerRequest(): void
    {
        if (isset($this->client->id) && isset($this->client->secret)) {
            $this->serverRequest = $this->serverRequest->withParsedBody([
                'grant_type' => 'password',
                'username' => $this->dto->email,
                'client_id' => $this->client->id,
                'password' => $this->dto->password,
                'client_secret' => $this->client->secret,
                'scope' => '*',
            ]);
        } else {
            throw new OauthClientNotFoundException();
        }
    }

    /**
     * @throws AuthorizationException
     * @throws OAuthServerException
     */
    protected function createAuthenticationToken(): void
    {
        $serverRequest = $this->serverRequest;
        $response = $this->withErrorHandling(function () use ($serverRequest) {
            return $this->convertResponse(
                $this->server->respondToAccessTokenRequest($serverRequest, new Psr7Response)
            );
        });

        $this->tokenData = json_decode($response->getContent(), true) ?? [];

        if (empty($this->tokenData)) {
            throw new AuthorizationException();
        }
    }
}
