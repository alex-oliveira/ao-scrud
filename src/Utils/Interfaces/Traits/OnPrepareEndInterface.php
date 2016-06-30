<?php

namespace AoScrud\Utils\Interfaces\Traits;

interface OnPrepareEndInterface
{

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onPrepareEnd(\Closure $closure);

    public function triggerOnPrepareEnd();

}