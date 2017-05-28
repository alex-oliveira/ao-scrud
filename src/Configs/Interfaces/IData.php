<?php

namespace AoScrud\Interfaces;

use Closure;
use Illuminate\Support\Collection;

interface IData
{

    /**
     * @param null|array|Collection|Closure $data
     * @return $this|Collection
     */
    public function data($data = null);

    /**
     * @param array|Collection|Closure $data
     * @return $this
     */
    public function setData($data);

    /**
     * @return Collection
     */
    public function getData();

}