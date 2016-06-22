<?php

namespace AoScrud\Repositories\Interfaces\Methods;

interface OnPrepareInterface
{

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onPrepare(\Closure $closure);

    public function triggerOnPrepare();

}