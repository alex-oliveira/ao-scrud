<?php

namespace AoScrud\Utils\Traits;

use Closure;
use Illuminate\Support\Collection;

trait OtherColumns
{

    /**
     * @var null|array|Closure|Collection
     */
    protected $otherColumns = null;

    /**
     * @param null|array|Closure|Collection $columns
     * @return $this|Collection
     */
    public function otherColumns($columns = null)
    {
        if (is_null($columns))
            return $this->getOtherColumns();
        return $this->setOtherColumns($columns);
    }

    /**
     * @param array|Closure|Collection $columns
     * @return $this
     */
    public function setOtherColumns($columns)
    {
        $this->otherColumns = is_array($columns) ? collect($columns) : $columns;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getOtherColumns()
    {
        if ($this->otherColumns instanceof Collection)
            return $this->otherColumns;

        if (is_null($this->otherColumns))
            return $this->otherColumns = collect([]);

        if (is_array($this->otherColumns))
            return $this->otherColumns = collect($this->otherColumns);

        if ($this->otherColumns instanceof Closure) {
            $closure = $this->otherColumns;
            $result = $closure($this);
            return is_array($result) ? collect($result) : $result;
        }

        return $this->otherColumns = collect([]);
    }

}