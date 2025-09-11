<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Definisikan Gate untuk 'admin'
        Gate::define('is-admin', function (User $user) {
            return $user->role === 'admin';
        });

        // Definisikan Gate untuk 'user' biasa
        Gate::define('is-user', function (User $user) {
            return $user->role === 'user';
        });
    }
}
