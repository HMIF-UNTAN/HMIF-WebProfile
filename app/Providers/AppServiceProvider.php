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
        $json = env('GOOGLE_CREDENTIAL_JSON');
        $path = storage_path('app/google/service-account.json');

        if ($json && !file_exists($path)) {
            @mkdir(dirname($path), 0775, true);
            $decoded = json_decode($json, true);

            // INI PENTING: ubah literal \n ke newline asli
            if (isset($decoded['private_key'])) {
                $decoded['private_key'] = str_replace('\\n', "\n", $decoded['private_key']);
            }

            file_put_contents($path, json_encode($decoded, JSON_PRETTY_PRINT));
        }

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
