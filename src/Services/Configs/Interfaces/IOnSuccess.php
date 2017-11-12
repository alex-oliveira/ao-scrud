<?php

namespace AoScrud\Services\Configs\Interfaces;

interface IOnSuccess
{

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onSuccess(\Closure $closure);

    /**
     * @param mixed $result
     * @return mixed
     */
    public function triggerOnSuccess($result);

}