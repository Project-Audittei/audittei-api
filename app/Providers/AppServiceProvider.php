<?php

namespace App\Providers;

use App\Services\EmpresaService;
use App\Services\EscritorioService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(EscritorioService::class, function($app) {
            return new EscritorioService();
        });
        
        $this->app->singleton(EmpresaService::class, function($app) {
            return new EmpresaService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
