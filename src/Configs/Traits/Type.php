<?php

namespace AoScrud\Traits;

use Closure;

trait Type
{

    /**
     * @var int|Closure
     */
    protected $type = 0;

    /**
     * @param null|int|Closure $type
     * @return $this|int
     */
    public function type($type = null)
    {
        if (is_null($type))
            return $this->getType();
        return $this->setType($type);
    }

    /**
     * @param int|Closure $type
     * @return $this
     */
    public function setType($type)
    {
        if (is_numeric($type) && is_int($type + 0) && $type >= 0)
            $this->type = $type;

        elseif ($type instanceof Closure)
            $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

}
