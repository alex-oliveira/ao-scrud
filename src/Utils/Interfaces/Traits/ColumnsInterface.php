<?php

namespace AoScrud\Utils\Interfaces\Traits;

use Closure;
use Illuminate\Support\Collection;

interface ColumnsInterface
{

    /**
     * @param null|array|Closure|Collection $columns
     * @return $this|Collection
     */
    public function columns($columns = null);

    /**
     * @param array|Closure|Collection $columns
     * @return $this
     */
    public function setColumns($columns);

    /**
     * @return Collection
     */
    public function getColumns();

    //------------------------------------------------------------------------------------------------------------------

    /**
     * @param array $except
     * @return Collection
     */
    public function getAllColumns(array $except = []);

}