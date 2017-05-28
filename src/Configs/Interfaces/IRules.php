<?php

namespace AoScrud\Configs\Interfaces;

use Closure;
use Illuminate\Support\Collection;

interface IRules
{

    /**
     * @param null|string|array|Collection|Closure $rules
     * @return $this|string|Collection
     */
    public function rules($rules = null);

    /**
     * @param string|array|Collection|Closure $rules
     * @return $this
     */
    public function setRules($rules);

    /**
     * @return string|Collection
     */
    public function getRules();

}