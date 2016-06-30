<?php

namespace AoScrud\Utils\Interfaces\Traits;

use Closure;

interface SelectInterface
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