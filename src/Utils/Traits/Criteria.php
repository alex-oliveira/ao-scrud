<?php

namespace AoScrud\Utils\Traits;

use Closure;
use AoScrud\Utils\Criteria\BaseCriteria;
use Illuminate\Support\Collection;

trait Criteria
{

    /**
     * @var null|array|Closure|Collection
     */
    protected $criteria = null;

    /**
     * @param null|array|Closure|Collection $criteria
     * @return $this|Collection
     */
    public function criteria($criteria = null)
    {
        if (is_null($criteria))
            return $this->getCriteria();
        return $this->setCriteria($criteria);
    }

    /**
     * @param array|Closure|Collection $criteria
     * @return $this
     */
    public function setCriteria($criteria)
    {
        $this->criteria = is_array($criteria) ? collect($criteria) : $criteria;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getCriteria()
    {
        if ($this->criteria instanceof Collection)
            return $this->criteria;

        if (is_null($this->criteria))
            return $this->criteria = collect([]);

        if (is_array($this->criteria))
            return $this->criteria = collect($this->criteria);

        if ($this->criteria instanceof Closure) {
            $closure = $this->criteria;
            $result = $closure($this);
            return is_array($result) ? collect($result) : $result;
        }

        return $this->criteria = collect([]);
    }

    public function runCriteria()
    {
        foreach ($this->criteria()->all() as $key => $criteria) {
            if (is_string($criteria) && is_subclass_of($criteria, BaseCriteria::class))
                $this->criteria->put($key, ($criteria = app($criteria)));

            if ($criteria instanceof BaseCriteria)
                $criteria->apply($this);
        }
    }

}