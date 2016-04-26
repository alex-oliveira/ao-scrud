<?php

namespace AoScrud\Repositories\Interfaces\Methods;

use Illuminate\Support\Collection;

interface WithInterface
{

    /**
     * @param array|null $with
     * @return $this|Collection
     */
    public function with(array $with = null);

    /**
     * @return Collection
     */
    public function getWith();

    /**
     * @param array $with
     * @return $this
     */
    public function setWith(array $with);

}