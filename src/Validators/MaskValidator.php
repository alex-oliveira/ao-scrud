<?php

namespace AoScrud\Validators;

class MaskValidator
{

    public function validate($attribute, $value, $parameters, $validator)
    {
        dump($attribute);
        dump($value);
        dump($parameters);
        dump($validator);

        return false;
    }

}
