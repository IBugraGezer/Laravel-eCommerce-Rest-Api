<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\CategoryPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('store-category', function(User $user) {

        });

        Gate::define('update-category', function(User $user) {
            return $user->tokenCan('admin') === true;
        });

        Gate::define('destroy-category', function(User $user) {
            return $user->tokenCan('admin') === true;
        });
    }
}
