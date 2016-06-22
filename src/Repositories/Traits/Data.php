<?php

namespace AoScrud\Repositories\Traits;

use Illuminate\Support\Collection;

trait Data
{

    /**
     * @var null|Collection
     */
    protected $data = null;

    /**
     * @param array|null $data
     * @return $this|Collection
     */
    public function data(array $data = null)
    {
        if (is_null($data))
            return $this->getData();
        return $this->setData($data);
    }

    /**
     * @return Collection
     */
    public function getData()
    {
        return is_null($this->data) ? $this->data = collect([]) : $this->data;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = collect($data);
        return $this;
    }

}