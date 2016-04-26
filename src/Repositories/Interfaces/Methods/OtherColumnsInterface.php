<?php

namespace AoScrud\Repositories\Interfaces\Methods;

use Illuminate\Support\Collection;

interface OtherColumnsInterface
{

    /**
     * @param array|null $columns
     * @return $this|Collection
     */
    public function otherColumns(array $columns = null);

    /**
     * @return Collection
     */
    public function getOtherColumns();

    /**
     * @param array $columns
     * @return $this
     */
    public function setOtherColumns(array $columns);

}