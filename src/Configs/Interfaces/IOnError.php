<?php

namespace AoScrud\Interfaces;

interface IOnError
{

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onError(\Closure $closure);

    /**
     * @param \Exception $e
     */
    public function triggerOnError(\Exception $e);

}