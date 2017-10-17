<?php

namespace Orion\Cep;

use Orion\Cep\Service\CepService;
use Illuminate\Support\ServiceProvider;

class CepServiceProvider extends ServiceProvider
{

    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CepService::class, function(){
            return new CepService();
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [CepService::class];
    }
}
