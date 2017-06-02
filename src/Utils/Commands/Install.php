<?php

namespace AoScrud\Commands;

use Artisan;
use Illuminate\Console\Command;

class Install extends Command
{

    protected $signature = 'app:install';

    protected $description = 'Command description';

    public function handle()
    {
        Artisan::call('vendor:publish', ['--force' => true]);
        echo Artisan::output();

        exec('composer dump');

        Artisan::call('migrate:refresh');
        echo Artisan::output();

        Artisan::call('db:seed');
        echo Artisan::output();
    }

}