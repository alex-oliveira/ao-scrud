<?php

namespace AoScrud\Utils\Tools;

use Route;

class RouterGerator
{
    protected $configs = [];

    protected $routes = [
        // ['method' => 'get|post|delete|put', 'url' => 'prefix', 'configs' => ['as' => 'name', ...]]
    ];

    protected $only = [];

    protected $exept = [];

    // CONFIGS //-------------------------------------------------------------------------------------------------------

    public function configs(array $configs = null)
    {
        if (is_null($configs))
            return $this->getConfigs();
        return $this->setConfigs($configs);
    }

    public function getConfigs()
    {
        return $this->configs;
    }

    public function setConfigs(array $configs = [])
    {
        $this->configs = $configs;
        return $this;
    }

    // ROUTES //--------------------------------------------------------------------------------------------------------

    public function routes(array $routes = null)
    {
        if (is_null($routes))
            return $this->getRoutes();
        return $this->setRoutes($routes);
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function setRoutes(array $routes = [])
    {
        $this->routes = $routes;
        return $this;
    }

    // ONLY //--------------------------------------------------------------------------------------------------------

    public function only(array $only = null)
    {
        if (is_null($only))
            return $this->getOnly();
        return $this->setOnly($only);
    }

    public function getOnly()
    {
        return $this->only;
    }

    public function setOnly(array $only = [])
    {
        $this->only = $only;
        return $this;
    }

    // EXEPT //--------------------------------------------------------------------------------------------------------

    public function exept(array $exept = null)
    {
        if (is_null($exept))
            return $this->getExept();
        return $this->setExept($exept);
    }

    public function getExept()
    {
        return $this->exept;
    }

    public function setExept(array $exept = [])
    {
        $this->exept = $exept;
        return $this;
    }

    // CONTROLLER //----------------------------------------------------------------------------------------------------

    public function controller($controller)
    {
        foreach ($this->routes as $k => $route) {
            $action = substr($this->routes[$k]['configs']['uses'], strrpos($this->routes[$k]['configs']['uses'], '@'));
            $this->routes[$k]['configs']['uses'] = $controller . $action;
        }
        return $this;
    }

    // MAKE //----------------------------------------------------------------------------------------------------------

    public function make()
    {
        Route::group($this->configs(), function () {
            $list = $this->only();
            if (count($list) > 0) {
                foreach ($this->routes() as $route)
                    if (in_array($route['configs']['as'], $list))
                        $this->do($route['method'], $route['url'], $route['configs']);
                return;
            }

            $list = $this->exept();
            if (count($list) > 0) {
                foreach ($this->routes() as $route)
                    if (!in_array($route['configs']['as'], $list))
                        $this->do($route['method'], $route['url'], $route['configs']);
                return;
            }

            foreach ($this->routes() as $route)
                $this->do($route['method'], $route['url'], $route['configs']);
        });
    }

    protected function do($method, $url, $configs)
    {
        Route::$method($url, $configs);
    }

}
