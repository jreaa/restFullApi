<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::tokensExpireIn(Carbon::now()->addMinutes(30));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
        Passport::enableImplicitGrant();

        Passport::tokensCan([
            'purchase-product' => 'Create new transaction for a specific product',
            'manage-product'   => 'Create, read, update and delete products (CRUD)',
            'manage-account'   => 'Read your account data, id, nme, email, if vrified, and if 
            admin (cannot read password).Modify your account data (email, and password).
            Cannot delete your account',
            'read-general'    => 'Read general information like purchasing categories, purchased
            products, selling products, selling categories, your transactions (purchases
            and sales)',
        ]);
    }
}
