<?php

namespace AoScrud\Utils\Checkers;

abstract class CheckerAbstract
{

    /**
     * Responsible method for check data before of operations.
     *
     * @param mixed $data
     */
    abstract public function check($data);

}