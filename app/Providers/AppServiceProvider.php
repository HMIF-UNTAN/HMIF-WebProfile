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
        $jsonEnv = env('GOOGLE_CREDENTIAL_JSON');
        $path = storage_path('app/google/service-account.json');

        if ($jsonEnv && !file_exists($path)) {
            // Coba decode dulu untuk memastikan string JSON valid
            try {
                $decoded = json_decode($jsonEnv, true, 512, JSON_THROW_ON_ERROR);

                // Buat folder jika belum ada
                if (!is_dir(dirname($path))) {
                    mkdir(dirname($path), 0775, true);
                }

                // Simpan file
                file_put_contents($path, json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
            } catch (\JsonException $e) {
                logger()->error('Invalid GOOGLE_CREDENTIAL_JSON: ' . $e->getMessage());
            }
        }

        // HTTPS paksa di production
        if (env('APP_ENV') === 'production' && env('APP_URL')) {
            \URL::forceScheme('https');
        }

        \Illuminate\Pagination\Paginator::useTailwind();

        // Share data kontak ke semua view
        \View::composer('*', function ($view) {
            $kontak = \App\Models\Kontak::first();
            $view->with('kontak', $kontak);
        });
    }
}
