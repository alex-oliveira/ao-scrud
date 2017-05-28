<?php

namespace AoScrud\Configs\Interfaces;

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