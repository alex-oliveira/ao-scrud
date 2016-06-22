<?php

namespace AoScrud\Repositories\Interfaces\Methods;

interface OnExecuteErrorInterface
{

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onExecuteError(\Closure $closure);

    /**
     * @param \Exception $e
     */
    public function triggerOnExecuteError(\Exception $e);

}