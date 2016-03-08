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

//if (!function_exists('fail')) {
//
//    /**
//     * @return \AoScrud\RestException
//     */
//    function fail($code, $message)
//    {
//        //return app('fail');
//    }
//
//}