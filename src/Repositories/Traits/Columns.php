<?php

namespace AoScrud\Repositories\Traits;

use Illuminate\Support\Collection;

trait Columns
{

    /**
     * @var Collection
     */
    protected $columns = null;

    /**
     * @param array|null $columns
     * @return $this|Collection
     */
    public function columns(array $columns = null)
    {
        if (is_null($columns))
            return $this->getColumns();
        return $this->setColumns($columns);
    }

    /**
     * @return Collection
     */
    public function getColumns()
    {
        return is_null($this->columns) ? $this->columns = collect([]) : $this->columns;
    }

    /**
     * @param array $columns
     * @return $this
     */
    public function setColumns(array $columns)
    {
        $this->columns = collect($columns);
        return $this;
    }

}