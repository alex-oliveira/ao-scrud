<?php

namespace AoScrud\Utils\Interfaces\Traits;

use Illuminate\Support\Collection;

interface DataInterface
{

    /**
     * @param null|array $data
     * @return $this|Collection
     */
    public function data(array $data = null);

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data);

    /**
     * @return Collection
     */
    public function getData();

}