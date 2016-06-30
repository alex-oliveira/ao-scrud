<?php

namespace AoScrud\Utils\Interfaces\Traits;

interface OnErrorInterface
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