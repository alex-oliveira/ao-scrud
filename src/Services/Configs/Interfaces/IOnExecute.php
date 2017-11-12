<?php

namespace AoScrud\Services\Configs\Interfaces;

interface IOnExecute
{

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onExecute(\Closure $closure);

    public function triggerOnExecute();

}