<?php

namespace AoScrud\Repositories\Interfaces\Methods;

use Illuminate\Support\Collection;

interface RulesInterface
{

    /**
     * @param null|string|array|Collection $rules
     * @return $this|Collection
     */
    public function rules($rules = null);

    /**
     * @return string|Collection
     */
    public function getRules();

    /**
     * @param string|array|Collection $rules
     * @return $this
     */
    public function setRules($rules);

}