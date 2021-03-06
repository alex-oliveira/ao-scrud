<?php

namespace AoScrud\Services\Configs\Interfaces;

interface IOnPrepare
{

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onPrepare(\Closure $closure);

    public function triggerOnPrepare();

}