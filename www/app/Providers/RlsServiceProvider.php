<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\Rls;

class RlsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Rls::class, function ($app) {
            return new Rls();
        });
    }
}
