<?php

namespace AoScrud\Repositories\Traits;

use Illuminate\Support\Collection;


trait With
{

    /**
     * @var null|Collection
     */
    protected $with = null;

    /**
     * @param array|null $with
     * @return $this|Collection
     */
    public function with(array $with = null)
    {
        if (is_null($with))
            return $this->getWith();
        return $this->setWith($with);
    }

    /**
     * @return Collection
     */
    public function getWith()
    {
        return is_null($this->with) ? $this->with = collect([]) : $this->with;
    }

    /**
     * @param array $with
     * @return $this
     */
    public function setWith(array $with)
    {
        $this->with = collect($with);
        return $this;
    }

}