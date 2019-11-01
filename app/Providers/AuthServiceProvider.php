<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use app\Post;
use app\User;
use app\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //\App\Post::class => \App\Policies\PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() 
    {
        $this->registerPolicies();

        $permissions = \App\Permission::with('roles')->get();

        foreach($permissions as $permission) {
            gate::define($permission->name, function(User $user) use($permission) {
                return $user->hasPermission($permission);
            });
        }

        /*gate::before(function(User $user, $ability) {
            if($user->hasAnyRoles('adm')) return true;
        });*/
    }
}
