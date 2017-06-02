<?php

namespace AoScrud\Configs\Traits;

trait Total
{

    /**
     * @var bool
     */
    protected $total = false;

    /**
     * @param null|bool $active
     * @return $this|bool
     */
    public function total($active = null)
    {
        if (is_null($active))
            return $this->total;
        return $active ? $this->withTotal() : $this->withoutTotal();
    }

    /**
     * @return $this
     */
    public function withTotal()
    {
        $this->total = true;
        return $this;
    }

    /**
     * @return $this
     */
    public function withoutTotal()
    {
        $this->total = false;
        return $this;
    }

}