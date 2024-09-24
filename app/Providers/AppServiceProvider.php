<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

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
        $this->loadViewsFrom(resource_path('platform'), 'platform');

        Livewire::addPersistentMiddleware([
            \App\Http\Middleware\IdentifyTenantMiddleware::class,
        ]);
    }
}
