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

if (!function_exists('validate')) {

    /**
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param array $labels
     * @return \Illuminate\Validation\Validator
     */
    function validate(array $data, array $rules, array $messages = [], array $labels = [])
    {
        $validator = app('validator')->make($data, $rules, $messages, $labels);

        if ($validator->fails())
            abort(412, json_encode($validator->errors()->all()));

        return $validator;
    }

}