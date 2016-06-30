<?php

namespace AoScrud\Utils\Traits;

use Closure;
use Illuminate\Support\Collection;

trait Rules
{

    /**
     * @var null|string|array|Closure|Collection
     */
    protected $rules = null;

    /**
     * @param null|string|array|Closure|Collection $rules
     * @return $this|string|Collection
     */
    public function rules($rules = null)
    {
        if (is_null($rules))
            return $this->getRules();
        return $this->setRules($rules);
    }

    /**
     * @param string|array|Closure|Collection $rules
     * @return $this
     */
    public function setRules($rules)
    {
        $this->rules = is_array($rules) ? collect($rules) : $rules;
        return $this;
    }

    /**
     * @return string|Collection
     */
    public function getRules()
    {
        if ($this->rules instanceof Collection)
            return $this->rules;

        if (is_array($this->rules))
            return $this->rules = collect($this->rules);

        if ($this->rules instanceof Closure) {
            $closure = $this->rules;
            $result = $closure($this);
            return is_array($result) ? collect($result) : $result;
        }

        return $this->rules;
    }

}