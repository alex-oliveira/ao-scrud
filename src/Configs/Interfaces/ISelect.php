<?php

namespace AoScrud\Interfaces;

use Closure;

interface ISelect
{

    /**
     * @param null|Closure $select
     * @return $this|Closure
     */
    public function select(Closure $select = null);

    /**
     * @param Closure $select
     * @return $this
     */
    public function setSelect(Closure $select);

    /**
     * @return Closure
     */
    public function getSelect();

    /**
     * @return Closure
     */
    public function getSelectDefault();

}