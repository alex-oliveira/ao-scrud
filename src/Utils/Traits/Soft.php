<?php

namespace AoScrud\Utils\Traits;

trait Soft
{

    /**
     * @var bool
     */
    protected $soft = false;

    /**
     * @param null|bool $active
     * @return $this|bool
     */
    public function soft($active = null)
    {
        if (is_null($active))
            return $this->soft;
        return $active ? $this->withSoftDelete() : $this->withoutSoftDelete();
    }

    /**
     * @return $this
     */
    public function withSoftDelete()
    {
        $this->soft = true;
        return $this;
    }

    /**
     * @return $this
     */
    public function withoutSoftDelete()
    {
        $this->soft = false;
        return $this;
    }

}