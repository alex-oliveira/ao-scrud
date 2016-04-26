<?php

namespace AoScrud\Repositories\Traits;

use Illuminate\Support\Collection;

trait Rules
{

    /**
     * @var Collection
     */
    protected $rules = null;

    /**
     * @param array|null $rules
     * @return $this|Collection
     */
    public function rules(array $rules = null)
    {
        if (is_null($rules))
            return $this->getRules();
        return $this->setRules($rules);
    }

    /**
     * @return Collection
     */
    public function getRules()
    {
        return is_null($this->rules) ? $this->rules = collect([]) : $this->rules;
    }

    /**
     * @param array $rules
     * @return $this
     */
    public function setRules(array $rules)
    {
        $this->rules = collect($rules);
        return $this;
    }

}