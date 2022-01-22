<?php

namespace App\Providers;

use App\Models\RealForm;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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

        Gate::define("read-write-form", function(User $user, RealForm $form) {
            return $user->id === $form->user_id;
        });

        Gate::define("manage-user", function(User $user) {
            return $user->username === "admin";
        });

        Gate::define("delete-user", function(User $user, User $delete) {
            Gate::forUser( $user )->authorize("manage-user");
            return $user->id !== $delete->id;
        });

        Gate::define("access-backend", function(User $user) {
            return $user->username === "admin";
        });
    }
}
