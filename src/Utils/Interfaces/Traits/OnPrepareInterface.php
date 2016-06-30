<?php

namespace AoScrud\Utils\Interfaces\Traits;

interface OnPrepareInterface
{

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onPrepare(\Closure $closure);

    public function triggerOnPrepare();

}