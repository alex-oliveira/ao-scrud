<?php

namespace AoScrud\Repositories\Interfaces\Methods;

interface OnExecuteInterface
{

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onExecute(\Closure $closure);

    public function triggerOnExecute();

}