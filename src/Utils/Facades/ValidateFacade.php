<?php

namespace AoScrud\Utils\Facades;

class ValidateFacade
{

    public function run()
    {

    }

}

//if (!function_exists('validate')) {
//
//    /**
//     * @param array $data
//     * @param array $rules
//     * @param array $messages
//     * @param array $labels
//     * @return \Illuminate\Validation\Validator
//     */
//    function validate(array $data, array $rules, array $messages = [], array $labels = [])
//    {
//        $validator = app('validator')->make($data, $rules, $messages, $labels);
//
//        if ($validator->fails())
//            abort(400, json_encode($validator->errors()->all()));
//
//        return $validator;
//    }
//
//}