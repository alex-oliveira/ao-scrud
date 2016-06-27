<?php

namespace AoScrud\Repositories\Interfaces\Methods;

interface SoftInterface
{

    /**
     * @param bool|null $active
     * @return $this
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