<?php

namespace AoScrud\Repositories\Interfaces\Methods;

interface OnPrepareEndInterface
{

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onPrepareEnd(\Closure $closure);

    public function triggerOnPrepareEnd();

}