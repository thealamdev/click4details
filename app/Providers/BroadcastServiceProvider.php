<?php

namespace App\Providers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services
     * @return void
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        Broadcast::routes();
        require base_path('routes/channels.php');
    }
}
