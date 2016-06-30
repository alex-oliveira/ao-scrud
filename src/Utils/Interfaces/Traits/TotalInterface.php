<?php

namespace AoScrud\Utils\Interfaces\Traits;

interface TotalInterface
{

    /**
     * @param null|bool $active
     * @return $this|bool
     */
    public function total($active = null);

    /**
     * @return $this
     */
    public function withTotal();

    /**
     * @return $this
     */
    public function withoutTotal();

}