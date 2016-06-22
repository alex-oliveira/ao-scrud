<?php

namespace AoScrud\Repositories\Interfaces\Methods;

interface TotalInterface
{

    /**
     * @return $this
     */
    public function total();

    /**
     * @return $this
     */
    public function withTotal();

    /**
     * @return $this
     */
    public function withoutTotal();

}