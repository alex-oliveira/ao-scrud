<?php

namespace AoScrud\Utils\Interfaces\Traits;

interface SoftInterface
{

    /**
     * @param null|bool $active
     * @return $this|bool
     */
    public function soft($active = null);

    /**
     * @return $this
     */
    public function withSoftDelete();

    /**
     * @return $this
     */
    public function withoutSoftDelete();

}