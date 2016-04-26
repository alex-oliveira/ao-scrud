<?php

namespace AoScrud\Repositories\Traits;

use Illuminate\Support\Collection;

trait OtherColumns
{

    /**
     * @var Collection
     */
    protected $otherColumns = null;

    /**
     * @param array|null $columns
     * @return $this|Collection
     */
    public function otherColumns(array $columns = null)
    {
        if (is_null($columns))
            return $this->getOtherColumns();
        return $this->setOtherColumns($columns);
    }

    /**
     * @return Collection
     */
    public function getOtherColumns()
    {
        return is_null($this->otherColumns) ? $this->otherColumns = collect([]) : $this->otherColumns;
    }

    /**
     * @param array $columns
     * @return $this
     */
    public function setOtherColumns(array $columns)
    {
        $this->otherColumns = collect($columns);
        return $this;
    }

}