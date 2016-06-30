<?php

namespace AoScrud\Utils\Interfaces\Traits;

interface OnPrepareErrorInterface
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