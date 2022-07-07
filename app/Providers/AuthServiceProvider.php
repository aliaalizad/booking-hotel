<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
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
     * Register any auth`entication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        foreach (Permission::all() as $permission) {
            Gate::define($permission->name, function($user, $guard) use ($permission) {
                $permission = Permission::whereName($permission->name)->whereGuard($guard)->first();
                return $user->hasPermission($permission);
            });
        }

    }
}
