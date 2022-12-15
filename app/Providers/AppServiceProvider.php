<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        // membuat gates ( gerbang akses ) sebelum menambahkan field isadmin
        // Gate::define('admin', function(User $user) {
        //     return $user->username === 'andhikaprasetya';
        // });

         // membuat gates ( gerbang akses ) ketika field isadmin sudah ada ditabel user
        Gate::define('admin', function(User $user) {
            return $user->is_admin;
        });
    }
}
