<?php

namespace AoScrud\Utils\Criteria;

use Illuminate\Support\Collection;
use Prettus\Repository\Contracts\CriteriaInterface;

abstract class BaseSearchCriteria implements CriteriaInterface
{

    /**
     * @var Collection
     */
    protected $data;

    /**
     * @return Collection $data
     */
    public function data()
    {
        return $this->data;
    }

    /**
     * @param Collection $data
     */
    public function setData(Collection $data)
    {
        $this->data = $data;
    }

}