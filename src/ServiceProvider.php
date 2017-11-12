<?php

namespace AoScrud;

use AoScrud\Console\DBDropCommand;
use AoScrud\Console\DBTruncateCommand;
use Illuminate\Support\ServiceProvider as LaraServiceProvider;
use Validator;

class ServiceProvider extends LaraServiceProvider
{

    public function boot()
    {
        Validator::extend('cep', 'AoScrud\Validators\CepValidator@validate');
        Validator::extend('cpf', 'AoScrud\Validators\CpfValidator@validate');
        Validator::extend('cnpj', 'AoScrud\Validators\CnpjValidator@validate');
        Validator::extend('password', 'AoScrud\Validators\PasswordValidator@validate');

        $this->commands([
            DBTruncateCommand::class,
            DBDropCommand::class,
        ]);
    }

    public function register()
    {
        $this->app->singleton('AoScrud', function ($app) {
            return new Tools();
        });

        require_once(__DIR__ . '/helpers.php');
    }

}