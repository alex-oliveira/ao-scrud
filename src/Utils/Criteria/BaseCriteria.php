<?php

namespace AoScrud\Utils\Criteria;

abstract class BaseCriteria
{

    /**
     * @param mixed
     * @return mixed
     */
    abstract public function apply($rep);

}