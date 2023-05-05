<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use App\Models\Statement\Statement;
use App\Policies\Statement\StatementPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Statement::class => StatementPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        $this->registerPassport();
    }

    private function registerPassport(): void
    {
        Passport::tokensExpireIn(now()->addDays());
        Passport::refreshTokensExpireIn(now()->addDays(2));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
