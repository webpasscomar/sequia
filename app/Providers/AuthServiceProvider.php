<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        // Creo un gate para permitir el acceso a ciertas caracteristicas dependiendo el rol del usuario
        // $this->registerPolicies();
        Gate::define('admin-role', function (User $user) {
            return $user->roles->contains('name', 'Administrador');
        });

        Gate::define('editor', function (User $user) {
            return $user->roles->contains('name', 'Editor');
        });
    }
}
