<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Blade directive to check toegangsniveau (gebruik: @hasRight(20) ... @endhasRight)
        Blade::if('hasRight', function ($level) {
            return auth()->check() && method_exists(auth()->user(), 'hasRight') && auth()->user()->hasRight(intval($level));
        });

        // Blade directive to check section access by afdeling/role (gebruik: @canAccess('inkoop') ... @endcanAccess)
        Blade::if('canAccess', function ($section) {
            return auth()->check() && method_exists(auth()->user(), 'canAccessSection') && auth()->user()->canAccessSection(strval($section));
        });
    }
}
