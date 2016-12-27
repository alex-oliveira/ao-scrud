<?php

namespace AoScrud;

use AoScrud\Utils\Facades\AoScrudFacade;
use AoScrud\Utils\Facades\ScrudFacade;
use AoScrud\Utils\Facades\TransactionFacade;
use AoScrud\Utils\Facades\ValidateFacade;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Validator;

class ServiceProvider extends BaseServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('cep', 'AoScrud\Utils\Validators\CepValidator@validate');
        Validator::extend('cpf', 'AoScrud\Utils\Validators\CpfValidator@validate');
        Validator::extend('cnpj', 'AoScrud\Utils\Validators\CnpjValidator@validate');

        $this->app->singleton('AoScrud', function ($app) {
            return new AoScrudFacade();
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