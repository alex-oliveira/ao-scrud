<?php

namespace AoScrud\Services\Configs\Interfaces;

interface IOnPrepareError
{

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onPrepareError(\Closure $closure);

    /**
     * @param \Exception $e
     */
    public function triggerOnPrepareError(\Exception $e);

}