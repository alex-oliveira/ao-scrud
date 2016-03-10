<?php

if (!function_exists('params')) {

    /**
     * @return \Illuminate\Support\Collection
     */
    function params()
    {
        return collect(request()->route()->parameters());
    }

}

if (!function_exists('validator')) {

    /**
     * @return \Illuminate\Validation\Factory
     */
    function validator()
    {
        return app('validator');
    }

}