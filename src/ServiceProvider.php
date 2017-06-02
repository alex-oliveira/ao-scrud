<?php

namespace AoScrud;

use AoScrud\Utils\Tools\Kit;
use Illuminate\Support\ServiceProvider as LaraServiceProvider;
use Validator;

class ServiceProvider extends LaraServiceProvider
{

    public function boot()
    {
        Validator::extend('cep', 'AoScrud\Utils\Validators\CepValidator@validate');
        Validator::extend('cpf', 'AoScrud\Utils\Validators\CpfValidator@validate');
        Validator::extend('cnpj', 'AoScrud\Utils\Validators\CnpjValidator@validate');
        Validator::extend('password', 'AoScrud\Utils\Validators\PasswordValidator@validate');
    }

    public function register()
    {
        $this->app->singleton('AoScrud', function ($app) {
            return new Kit();
        });

        require_once(__DIR__ . '/Utils/Helpers.php');
    }

}