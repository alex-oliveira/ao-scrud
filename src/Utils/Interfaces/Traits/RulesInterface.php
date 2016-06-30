<?php

namespace AoScrud\Utils\Interfaces\Traits;

use Closure;
use Illuminate\Support\Collection;

interface RulesInterface
{

    /**
     * @param null|string|array|Closure|Collection $rules
     * @return $this|string|Collection
     */
    public function rules($rules = null);

    /**
     * @param string|array|Closure|Collection $rules
     * @return $this
     */
    public function setRules($rules);

    /**
     * @return string|Collection
     */
    public function getRules();

}