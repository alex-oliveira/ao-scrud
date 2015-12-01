<?php

namespace AoScrud\Tools\Checkers;

abstract class CheckerAbstract
{

    /**
     * Responsible method for check data before of operations.
     *
     * @param mixed $data
     */
    abstract public function check($data);

}