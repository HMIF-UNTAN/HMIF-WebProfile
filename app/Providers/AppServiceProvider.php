<?php

namespace App\Providers;

use App\Models\Kontak;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (class_exists(\Laravel\Pail\PailServiceProvider::class)) {
                $this->app->register(\Laravel\Pail\PailServiceProvider::class);
            }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();

        View::composer('*', function ($view) {
            $kontak = Kontak::first();
            $view->with('kontak', $kontak);
        });
    }
}
