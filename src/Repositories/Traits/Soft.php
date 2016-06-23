<?php

namespace AoScrud\Repositories\Traits;

trait Soft
{

    /**
     * @var bool
     */
    protected $soft = false;

    /**
     * @param bool|null $active
     * @return $this
     */
    public function soft($active = null)
    {
        if (!is_null($active))
            $active ? $this->withSoftDelete() : $this->withoutSoftDelete();

        return $this->soft;
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