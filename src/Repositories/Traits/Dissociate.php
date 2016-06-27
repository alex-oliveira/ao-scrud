<?php

namespace AoScrud\Repositories\Traits;

use Illuminate\Support\Collection;

trait Dissociate
{

    /**
     * @var null|Collection
     */
    protected $dissociate = null;

    /**
     * @param array|null $dissociate
     * @return $this|Collection
     */
    public function dissociate(array $dissociate = null)
    {
        if (is_null($dissociate))
            return $this->getDissociate();
        return $this->setDissociate($dissociate);
    }

    /**
     * @return Collection
     */
    public function getDissociate()
    {
        return is_null($this->dissociate) ? $this->dissociate = collect([]) : $this->dissociate;
    }

    /**
     * @param array $dissociate
     * @return $this
     */
    public function setDissociate(array $dissociate)
    {
        $this->dissociate = collect($dissociate);
        return $this;
    }

}