<?php

namespace App\Providers;

use App\Repositories\Read\User\UserReadRepository;
use App\Repositories\Write\User\UserWriteRepository;
use App\Repositories\Write\Team\TeamWriteRepository;
use App\Repositories\Read\UserRole\UserRoleReadRepository;
use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Repositories\Write\UserRole\UserRoleWriteRepository;
use App\Repositories\Read\Statement\StatementReadRepository;
use App\Repositories\Write\User\UserWriteRepositoryInterface;
use App\Repositories\Write\Team\TeamWriteRepositoryInterface;
use App\Repositories\Write\Statement\StatementWriteRepository;
use App\Repositories\Read\OauthClients\OauthClientsReadRepository;
use App\Repositories\Read\UserRole\UserRoleReadRepositoryInterface;
use App\Repositories\Read\UserStatement\UserStatementReadRepository;
use App\Repositories\Read\Statement\StatementReadRepositoryInterface;
use App\Repositories\Write\UserRole\UserRoleWriteRepositoryInterface;
use App\Repositories\Write\UserStatement\UserStatementWriteRepository;
use App\Repositories\Write\Statement\StatementWriteRepositoryInterface;
use App\Repositories\Read\OauthClients\OauthClientsReadRepositoryInterface;
use App\Repositories\Read\UserStatement\UserStatementReadRepositoryInterface;
use App\Repositories\Write\UserStatement\UserStatementWriteRepositoryInterface;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            UserWriteRepositoryInterface::class,
            UserWriteRepository::class
        );

        $this->app->bind(
            UserReadRepositoryInterface::class,
            UserReadRepository::class
        );

        $this->app->bind(
            OauthClientsReadRepositoryInterface::class,
            OauthClientsReadRepository::class
        );

        $this->app->bind(
            UserRoleWriteRepositoryInterface::class,
            UserRoleWriteRepository::class
        );

        $this->app->bind(
            UserRoleReadRepositoryInterface::class,
            UserRoleReadRepository::class
        );

        $this->app->bind(
            TeamWriteRepositoryInterface::class,
            TeamWriteRepository::class,
        );

        $this->app->bind(
            StatementWriteRepositoryInterface::class,
            StatementWriteRepository::class,
        );

        $this->app->bind(
            StatementReadRepositoryInterface::class,
            StatementReadRepository::class
        );

        $this->app->bind(
            UserStatementWriteRepositoryInterface::class,
            UserStatementWriteRepository::class
        );

        $this->app->bind(
            UserStatementReadRepositoryInterface::class,
            UserStatementReadRepository::class
        );
    }
}
