<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Policies\BlogPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\RolePolicy;
// use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
            Role::class => RolePolicy::class,
            Permission::class => PermissionPolicy::class,
            Category::class => CategoryPolicy::class,
            Blog::class=> BlogPolicy::class,
        ];

    public function register(): void
    {
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::before(fn (User $user, string $ability) => $user->hasRole('admin') ? true : null);
    }
}
