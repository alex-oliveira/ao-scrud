<?php

namespace AoScrud\Repositories\Traits;

use AoScrud\Repositories\Criteria\BaseCriteria;
use Illuminate\Support\Collection;

trait Criteria
{

    /**
     * @var null|Collection
     */
    protected $criteria = null;

    /**
     * @param array|null $criteria
     * @return $this|Collection
     */
    public function criteria(array $criteria = null)
    {
        if (is_null($criteria))
            return $this->getCriteria();
        return $this->setCriteria($criteria);
    }

    /**
     * @return Collection
     */
    public function getCriteria()
    {
        return is_null($this->criteria) ? $this->criteria = collect([]) : $this->criteria;
    }

    /**
     * @param array $criteria
     * @return $this
     */
    public function setCriteria(array $criteria)
    {
        $this->criteria = collect($criteria);
        return $this;
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