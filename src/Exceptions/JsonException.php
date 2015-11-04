<?php

namespace AoScrud\Exceptions;

class JsonException extends \Exception
{

    public function getMessageArray()
    {
        return json_decode($this->getMessage(), true);
    }

}