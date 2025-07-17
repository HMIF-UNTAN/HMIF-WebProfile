<?php

namespace App\Providers;

use App\Models\Kontak;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL; 

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
        // HTTPS force di production
        if (env('APP_ENV') === 'production' && env('APP_URL')) {
            URL::forceScheme('https');
        }

        Paginator::useTailwind();

        View::composer('*', function ($view) {
            $kontak = Kontak::first();
            $view->with('kontak', $kontak);
        });
    }
}
