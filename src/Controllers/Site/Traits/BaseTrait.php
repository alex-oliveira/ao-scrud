<?php

namespace AoScrud\Controllers\Site\Traits;

use AoScrud\Repositories\BaseRepository;
use Illuminate\Support\Facades\Route;

trait BaseTrait
{

    /**
     * Prefix to route names.
     *
     * @var string
     */
    protected $routes = '';

    /**
     * Prefix to views names.
     *
     * @var string
     */
    protected $views = '';

    /**
     * Prefix to lang name.
     *
     * @var string
     */
    protected $lang = '';

    /**
     * The main repository.
     *
     * @var BaseRepository;
     */
    protected $repository;

    /**
     * Return the route list.
     *
     * @return \Illuminate\Routing\RouteCollection;
     */
    protected function routes()
    {
        return Route::getRoutes();
    }

    /**
     * Return the parameters of the route.
     *
     * @param  string $name
     * @param  array $params
     * @return string
     */
    protected function routeParams($name, $params)
    {
        $data = [];

        $route = $this->routes()->getByName($name);
        if ($route) {
            //$data = collect($params)->only($route->parameterNames());
            foreach ($route->parameterNames() as $param) {
                if (isset($params[$param]) && strlen($params[$param]) > 0)
                    $data[$param] = $params[$param];
            }
        }

        return $data;
    }

}
