<?php

namespace AoScrud\Services\Configs\Interfaces;

interface IOnExecuteError
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