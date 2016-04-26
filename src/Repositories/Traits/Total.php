<?php

namespace AoScrud\Repositories\Traits;

trait Total
{

    /**
     * @var bool
     */
    protected $total = false;

    /**
     * @return $this
     */
    public function total()
    {
        return $this->total;
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