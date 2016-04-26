<?php

namespace AoScrud\Repositories\Interfaces\Methods;

use Illuminate\Support\Collection;

interface CriteriaInterface
{

    /**
     * @param array|null $criteria
     * @return $this|Collection
     */
    public function criteria(array $criteria = null);

    /**
     * @return Collection
     */
    public function getCriteria();

    /**
     * @param array $criteria
     * @return $this
     */
    public function setCriteria(array $criteria);

}