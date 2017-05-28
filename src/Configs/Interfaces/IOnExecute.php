<?php

namespace AoScrud\Interfaces;

interface IOnExecute
{

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onExecute(\Closure $closure);

    public function triggerOnExecute();

}