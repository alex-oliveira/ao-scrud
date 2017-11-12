<?php

namespace AoScrud\Services\Configs\Interfaces;

interface IOnPrepareEnd
{

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onPrepareEnd(\Closure $closure);

    public function triggerOnPrepareEnd();

}