<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services
     * @return void
     */
    public function register(): void
    {
        $files = glob(app_path('Services/Helpers') . "/*.php");
        foreach ($files as $key => $file) {
            require_once $file;
        }
    }

    /**
     * Bootstrap services
     * @return void
     */
    public function boot(): void
    {
        // TODO: Implement boot() method
    }
}
