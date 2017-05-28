<?php

namespace AoScrud\Utils\Tools;

class Kit
{

    /**
     * @return Collection
     */
    public function params()
    {
        return collect(array_merge(request()->all(), request()->route()->parameters()));
    }

    /**
     * @return Controller
     */
    public function controller()
    {
        static $instance = null;

        if (is_null($instance))
            $instance = new Controller();

        return $instance;
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

}