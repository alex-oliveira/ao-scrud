<?php

namespace AoScrud\Repositories\Traits;

use Illuminate\Support\Collection;

trait Cascade
{

    /**
     * @var null|Collection
     */
    protected $cascade = null;

    /**
     * @param array|null $cascade
     * @return $this|Collection
     */
    public function cascade(array $cascade = null)
    {
        if (is_null($cascade))
            return $this->getCascade();
        return $this->setCascade($cascade);
    }

    /**
     * @return Collection
     */
    public function getCascade()
    {
        return is_null($this->cascade) ? $this->cascade = collect([]) : $this->cascade;
    }

    /**
     * @param array $cascade
     * @return $this
     */
    public function setCascade(array $cascade)
    {
        $this->cascade = collect($cascade);
        return $this;
    }

}