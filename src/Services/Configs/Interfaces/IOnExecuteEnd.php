<?php

namespace AoScrud\Services\Configs\Interfaces;

interface IOnExecuteEnd
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