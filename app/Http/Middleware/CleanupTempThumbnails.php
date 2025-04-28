<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CleanupTempThumbnails
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (session()->has('temp_thumbnails')) {
            foreach (session('temp_thumbnails') as $filename) {
                $path = storage_path('framework/cache/' . $filename);
                if (file_exists($path)) {
                    @unlink($path); // pakai @ untuk suppress warning
                }
            }

            session()->forget('temp_thumbnails');
        }

        return $response;
    }
}
