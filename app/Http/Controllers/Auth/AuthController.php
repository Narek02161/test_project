<?php

namespace App\Http\Controllers\Auth;

use App\Services\User\Dto\LoginDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Services\User\Dto\CreateUserDTO;
use App\Services\User\Actions\LoginAction;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\User\TokensResource;
use App\Http\Resources\User\RegisterResource;
use App\Services\User\Actions\RegisterUserAction;
use Illuminate\Auth\Access\AuthorizationException;
use Laravel\Passport\Exceptions\OAuthServerException;
use App\Exceptions\User\OauthClientNotFoundException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class AuthController extends Controller
{
    /**
     * @throws UnknownProperties
     * @throws AuthorizationException
     * @throws OAuthServerException
     * @throws OauthClientNotFoundException
     */
    public function register(
        RegisterRequest $request,
        RegisterUserAction $createUserAction
    ): RegisterResource {
        $dto = CreateUserDTO::fromRequest($request);

        $result = $createUserAction->run($dto);

        return new RegisterResource($result);
    }

    /**
     * @throws UnknownProperties
     * @throws AuthorizationException
     * @throws OAuthServerException
     * @throws OauthClientNotFoundException
     */
    public function login(
        LoginRequest $request,
        LoginAction $loginAction,
    ): TokensResource {
        $dto = LoginDTO::fromRequest($request);

        $result =  $loginAction->run($dto);

        return new TokensResource($result);
    }
}
