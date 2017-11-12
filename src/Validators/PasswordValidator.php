<?php

namespace AoScrud\Validators;

class PasswordValidator
{

    protected $number = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    protected $lower = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];

    protected $upper = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

    public function validate($attribute, $value, $parameters, $validator)
    {
        if (count($parameters) == 0)
            $parameters = ['number', 'lower', 'upper', 'text', 'symbol'];

        $values = str_split($value);

        if (in_array('number', $parameters) && !$this->has($values, $this->number))
            return false;

        if (in_array('lower', $parameters) && !$this->has($values, $this->lower))
            return false;

        if (in_array('upper', $parameters) && !$this->has($values, $this->upper))
            return false;

        if (in_array('text', $parameters) && !in_array('lower', $parameters) && !in_array('upper', $parameters) && !$this->has($values, array_merge($this->lower, $this->upper)))
            return false;

        if (in_array('symbol', $parameters) && !$this->has($values, array_merge($this->number, $this->lower, $this->upper), false))
            return false;

        return true;
    }

    protected function has($values, $list, $has = false)
    {
        foreach ($values as $v)
            if (in_array($v, $list) == $has)
                return true;
        return false;
    }

}
