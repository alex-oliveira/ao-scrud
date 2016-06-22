<?php

namespace AoScrud\Repositories\Interfaces\Methods;

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