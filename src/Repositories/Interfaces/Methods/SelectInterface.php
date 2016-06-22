<?php

namespace AoScrud\Repositories\Interfaces\Methods;

interface SelectInterface
{

    /**
     * @param \Closure|null $select
     * @return $this|\Closure
     */
    public function select(\Closure $select = null);

    /**
     * @return \Closure
     */
    public function getSelect();

    /**
     * @param \Closure $select
     * @return $this
     */
    public function setSelect(\Closure $select);

}