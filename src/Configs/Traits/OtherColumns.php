<?php

namespace AoScrud\Configs\Traits;

use Closure;
use Illuminate\Support\Collection;

trait OtherColumns
{

    /**
     * @var null|Collection|Closure
     */
    protected $otherColumns = null;

    /**
     * @param null|array|Collection|Closure $columns
     * @return $this|Collection
     */
    public function otherColumns($columns = null)
    {
        if (is_null($columns))
            return $this->getOtherColumns();
        return $this->setOtherColumns($columns);
    }

    /**
     * @param array|Collection|Closure $columns
     * @return $this
     */
    public function setOtherColumns($columns)
    {
        if (is_array($columns))
            $this->otherColumns = collect($columns);

        elseif ($columns instanceof Collection || $columns instanceof Closure)
            $this->otherColumns = $columns;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getOtherColumns()
    {
        if ($this->otherColumns instanceof Collection)
            return $this->otherColumns;

        if ($this->otherColumns instanceof Closure) {
            $closure = $this->otherColumns;
            $result = $closure($this);
            is_array($result) ? $result = collect($result) : null;
            return $result instanceof Collection ? $result : collect([]);
        }

        return $this->otherColumns = collect([]);
    }

}