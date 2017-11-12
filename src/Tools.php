<?php

namespace AoScrud;

use AoScrud\Tools\Incrementer;
use AoScrud\Tools\Router;
use AoScrud\Tools\Transaction;
use AoScrud\Tools\Validate;

class Tools
{

    /**
     * @param array|string $key
     * @param mixed $default
     * @return mixed
     */
    public static function config($key = null, $default = null)
    {
        $config = config($key, $default);

        if ($config instanceof \Closure)
            return $config();

        return $config;
    }

    /**
     * @return Collection
     */
    public function params()
    {
        return collect(array_merge(request()->all(), request()->route()->parameters()));
    }

    /**
     * @param $data
     * @return mixed
     */
    public function toArray($data)
    {
        if (is_array($data))
            return $data;

        if (is_object($data) && method_exists($data, 'toArray'))
            return $data->toArray();

        if ($data instanceof Collection)
            return $data->all();

        return $data;
    }

    /**
     * @return Router
     */
    public function router($controller = null)
    {
        $router = Router::build();

        if (isset($controller))
            $router->controller($controller);

        return $router;
    }

    /**
     * @return Transaction
     */
    public function transaction()
    {
        static $instance = null;

        if (is_null($instance))
            $instance = new Transaction();

        return $instance;
    }

    /**
     * @return Validate
     */
    public function validate()
    {
        static $instance = null;

        if (is_null($instance))
            $instance = new Validate();

        return $instance;
    }

    /**
     * @return Incrementer
     */
    public function incrementer()
    {
        static $instance = null;

        if (is_null($instance))
            $instance = new Incrementer();

        return $instance;
    }

}