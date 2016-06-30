<?php

namespace AoScrud\Utils\Traits;

trait Type
{

    /**
     * @var int
     */
    protected $type = 0;

    /**
     * @param int|null $type
     * @return $this|int
     */
    public function type($type = null)
    {
        if (is_null($type))
            return $this->getType();
        return $this->setType($type);
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

}
