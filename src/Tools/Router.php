<?php

namespace AoScrud\Tools;

use AoScrud\Traits\AoBuildTrait;
use Illuminate\Support\Collection;

class Router extends RouterGerator
{

    use AoBuildTrait;

    protected $routes = [
        ['method' => 'get', 'url' => '/', 'configs' => ['as' => 'index', 'uses' => '@index']],
        ['method' => 'get', 'url' => '/{id}', 'configs' => ['as' => 'show', 'uses' => '@show']],
        ['method' => 'post', 'url' => '/', 'configs' => ['as' => 'store', 'uses' => '@store']],
        ['method' => 'put', 'url' => '/{id}', 'configs' => ['as' => 'update', 'uses' => '@update']],
        ['method' => 'put', 'url' => '/{id}/restore', 'configs' => ['as' => 'restore', 'uses' => '@restore']],
        ['method' => 'delete', 'url' => '/{id}', 'configs' => ['as' => 'destroy', 'uses' => '@destroy']],
    ];

}
