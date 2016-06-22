<?php

namespace AoScrud\Repositories\Interfaces\Methods;

use Illuminate\Support\Collection;

interface ColumnsInterface
{

    /**
     * @param array|null $columns
     * @return $this|Collection
     */
    public function columns(array $columns = null);

    /**
     * @return Collection
     */
    public function getColumns();

    /**
     * @param array $columns
     * @return $this
     */
    public function setColumns(array $columns);

}