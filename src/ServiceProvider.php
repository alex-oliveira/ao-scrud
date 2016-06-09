<?php

namespace AoScrud;

use AoScrud\Utils\Facades\TransactionFacade;
use AoScrud\Utils\Facades\ValidateFacade;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('transaction', function ($app) {
            return new TransactionFacade();
        });
        $this->app->singleton('validate', function ($app) {
            return new ValidateFacade();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once(__DIR__ . '/Helpers.php');
    }

}
