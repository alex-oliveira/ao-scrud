<?php

namespace AoScrud\Services\Configs;

use AoScrud\Utils\Criteria\BaseCriteria;
use Closure;
use Illuminate\Support\Collection;

trait Criteria
{

    /**
     * @var null|Collection|Closure
     */
    protected $criteria = null;

    /**
     * @param null|array|Collection|Closure $criteria
     * @return $this|Collection
     */
    public function criteria($criteria = null)
    {
        if (is_null($criteria))
            return $this->getCriteria();
        return $this->setCriteria($criteria);
    }

    /**
     * @param array|Collection|Closure $criteria
     * @return $this
     */
    public function setCriteria($criteria)
    {
        if (is_array($criteria))
            $this->criteria = collect($criteria);

        elseif ($criteria instanceof Collection || $criteria instanceof Closure)
            $this->criteria = $criteria;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getCriteria()
    {
        if ($this->criteria instanceof Collection)
            return $this->criteria;

        if ($this->criteria instanceof Closure) {
            $closure = $this->criteria;
            $result = $closure($this);
            is_array($result) ? $result = collect($result) : null;
            return $result instanceof Collection ? $result : collect([]);
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