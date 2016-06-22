<?php

namespace AoScrud\Repositories\Interfaces\Methods;

use Illuminate\Support\Collection;

interface DataInterface
{

    /**
     * @param array|null $data
     * @return $this|Collection
     */
    public function data(array $data = null);

    /**
     * @return Collection
     */
    public function getData();

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data);

}