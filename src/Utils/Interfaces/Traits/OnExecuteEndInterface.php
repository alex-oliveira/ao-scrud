<?php

namespace AoScrud\Utils\Interfaces\Traits;

interface OnExecuteEndInterface
{

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onExecuteEnd(\Closure $closure);

    /**
     * @param mixed $result
     */
    public function triggerOnExecuteEnd($result);

}