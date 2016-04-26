<?php

namespace AoScrud\Repositories\Interfaces\Methods;

use Illuminate\Support\Collection;

interface RulesInterface
{

    /**
     * @param array|null $rules
     * @return $this|Collection
     */
    public function rules(array $rules = null);

    /**
     * @return Collection
     */
    public function getRules();

    /**
     * @param array $rules
     * @return $this
     */
    public function setRules(array $rules);

}