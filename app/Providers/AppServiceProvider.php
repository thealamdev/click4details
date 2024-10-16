<?php

namespace App\Providers;

use App\Facades\Upload;
use App\Services\Uploads\UploadManager;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(Upload::class, fn () => UploadManager::class);
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services
     * @return void
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
