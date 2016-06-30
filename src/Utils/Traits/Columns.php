<?php

namespace AoScrud\Utils\Traits;

use Closure;
use Illuminate\Support\Collection;

trait Columns
{

    /**
     * @var null|array|Closure|Collection
     */
    protected $columns = null;

    /**
     * @param null|array|Closure|Collection $columns
     * @return $this|Collection
     */
    public function columns($columns = null)
    {
        if (is_null($columns))
            return $this->getColumns();
        return $this->setColumns($columns);
    }

    /**
     * @param array|Closure|Collection $columns
     * @return $this
     */
    public function setColumns($columns)
    {
        $this->columns = is_array($columns) ? collect($columns) : $columns;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getColumns()
    {
        if ($this->columns instanceof Collection)
            return $this->columns;

        if (is_array($this->columns))
            return $this->columns = collect($this->columns);

        if ($this->columns instanceof Closure) {
            $closure = $this->columns;
            $result = $closure($this);
            return is_array($result) ? collect($result) : $result;
        }

        return $this->columns = collect([]);
    }

}