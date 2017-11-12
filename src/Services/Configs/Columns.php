<?php

namespace AoScrud\Services\Configs;

use AoScrud\Services\Configs\Interfaces\IOtherColumns;
use Closure;
use Illuminate\Support\Collection;

trait Columns
{

    /**
     * @var null|Collection|Closure
     */
    protected $columns = null;

    /**
     * @param null|array|Collection|Closure $columns
     * @return $this|Collection
     */
    public function columns($columns = null)
    {
        if (is_null($columns))
            return $this->getColumns();
        return $this->setColumns($columns);
    }

    /**
     * @param array|Collection|Closure $columns
     * @return $this
     */
    public function setColumns($columns)
    {
        if (is_array($columns))
            $this->columns = collect($columns);

        elseif ($columns instanceof Collection || $columns instanceof Closure)
            $this->columns = $columns;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getColumns()
    {
        if ($this->columns instanceof Collection)
            return $this->columns;

        if ($this->columns instanceof Closure) {
            $closure = $this->columns;
            $result = $closure($this);
            is_array($result) ? $result = collect($result) : null;
            return $result instanceof Collection ? $result : collect([]);
        }

        return $this->columns = collect([]);
    }

    //------------------------------------------------------------------------------------------------------------------

    /**
     * @param array $except
     * @return Collection
     */
    public function getAllColumns(array $except = [])
    {
        $columns = $this->getColumns();

        if ($this instanceof IOtherColumns)
            $columns = $columns->merge($this->getOtherColumns());

        $columns = $columns->unique();

        return $columns->diff($except);
    }

}