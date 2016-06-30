<?php

namespace AoScrud\Utils\Interfaces\Traits;

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