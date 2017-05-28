<?php

namespace AoScrud\Traits;

use Closure;
use Illuminate\Support\Collection;

trait Rules
{

    /**
     * @var null|string|Collection|Closure
     */
    protected $rules = null;

    /**
     * @param null|string|array|Collection|Closure $rules
     * @return $this|string|Collection
     */
    public function rules($rules = null)
    {
        if (is_null($rules))
            return $this->getRules();
        return $this->setRules($rules);
    }

    /**
     * @param string|array|Collection|Closure $rules
     * @return $this
     */
    public function setRules($rules)
    {
        if (is_array($rules))
            $this->rules = collect($rules);

        elseif ($rules instanceof Collection || $rules instanceof Closure)
            $this->rules = $rules;

        return $this;
    }

    /**
     * @return string|Collection
     */
    public function getRules()
    {
        if ($this->rules instanceof Collection)
            return $this->rules;

        if ($this->rules instanceof Closure) {
            $closure = $this->rules;
            $result = $closure($this);
            is_array($result) ? $result = collect($result) : null;
            return $result instanceof Collection || is_string($result) ? $result : collect([]);
        }

        return is_string($this->rules) ? $this->rules : $this->rules = collect([]);
    }

}