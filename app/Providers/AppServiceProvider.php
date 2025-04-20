<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // if (!class_exists('Alert')) {
        //     class_alias(Alert::class, 'Alert');
        // }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
