<?php

namespace AoScrud\Utils\Interfaces\Traits;

interface OnExecuteInterface
{

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onExecute(\Closure $closure);

    public function triggerOnExecute();

}