<?php

namespace App\Services\User\Actions;

use App\Models\User;
use App\Models\UserRole;
use App\Models\Team\Team;
use App\Enum\UserRoles\UserRoles;
use Illuminate\Support\Collection;
use App\Events\User\RegisterEvent;
use App\Services\User\Dto\CreateUserDTO;
use Illuminate\Auth\Access\AuthorizationException;
use App\Exceptions\User\OauthClientNotFoundException;
use Laravel\Passport\Exceptions\OAuthServerException;

class RegisterUserAction extends ParentAuthAction
{
    private Team $team;
    private UserRole $role;
    private Collection $result;

    /**
     * @throws AuthorizationException
     * @throws OAuthServerException
     * @throws OauthClientNotFoundException
     */
    public function run(CreateUserDTO $dto): Collection
    {
        $this->init($dto);

        $this->createUserModel();

        $this->saveUserModel();

        $this->assignRole();

        $this->createTeam();

        $this->attachUserTeam();

        $this->createServerRequest();

        $this->getPassportCredentials();

        $this->withParsedBodyToServerRequest();

        $this->createAuthenticationToken();

        $this->dispatch();

        $this->initializeResponse();

        return $this->result;
    }

    private function init(CreateUserDTO $dto): void
    {
        $this->dto = $dto;
    }

    private function createUserModel(): void
    {
        $this->user = User::createUser($this->dto);
    }

    private function assignRole(): void
    {
        $this->role = $this->userRoleReadRepository->getByName(
            UserRoles::ADMIN->value,
            ['permissions']
        );

        $this->user->assignRole($this->role);
    }

    private function createTeam(): void
    {
        $this->team = Team::create(
            $this->user->id,
            $this->user->email
        );

        $this->teamWriteRepository->save($this->team);
    }

    private function attachUserTeam(): void
    {
        $this->userWriteRepository->attachUserTeam(
            $this->user,
            $this->team->id,
            $this->role->id,
        );
    }

    private function saveUserModel(): void
    {
        $this->userWriteRepository->save($this->user);
    }

    private function dispatch(): void
    {
        RegisterEvent::dispatch(
            $this->user->id,
            $this->dto
        );
    }

    private function initializeResponse(): void
    {
        $this->result = collect([
            'user' => $this->user,
            'tokenData' => $this->tokenData
        ]);
    }
}
