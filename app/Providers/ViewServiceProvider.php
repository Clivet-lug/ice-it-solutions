<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Share logo data with all views
        View::composer('*', function ($view) {
            // Get the logo file path
            $logoPath = public_path('images/logo.jpg');

            // Check if the file exists
            if (file_exists($logoPath)) {
                // Read the image file and convert it to base64
                $logoData = base64_encode(file_get_contents($logoPath));
            } else {
                // Provide a fallback or empty string if logo doesn't exist
                $logoData = '';
                // Optionally log this issue
                Log::warning('Logo file not found at: ' . $logoPath);
            }

            $view->with('logoData', $logoData);
        });
    }
}