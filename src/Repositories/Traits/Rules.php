<?php

namespace AoScrud\Repositories\Traits;

use Illuminate\Support\Collection;

trait Rules
{

    /**
     * @var null|string|Collection
     */
    protected $rules = null;

    /**
     * @param null|string|array|Collection $rules
     * @return $this|Collection
     */
    public function rules($rules = null)
    {
        if (is_null($rules))
            return $this->getRules();
        return $this->setRules($rules);
    }

    /**
     * @return string|Collection
     */
    public function getRules()
    {
        return is_null($this->rules) ? $this->rules = collect([]) : $this->rules;
    }

    /**
     * @param string|array|Collection $rules
     * @return $this
     */
    public function setRules($rules)
    {
        $this->rules = is_array($rules) ? collect($rules) : $rules;
        return $this;
    }

}