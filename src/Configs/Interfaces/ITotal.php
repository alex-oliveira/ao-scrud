<?php

namespace AoScrud\Configs\Interfaces;

interface ITotal
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