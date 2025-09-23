<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Menu;
use App\Policies\MenunewPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
    
    protected $policies = [
        Menu::class => MenunewPolicy::class
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        foreach ($this->policies as $model => $policy) {
            Gate::policy($model, $policy);
        }
        
        Gate::define('testcheck2', function(User $user, $test) {
            return $test == "test";
        });
    }
}
