<?php

namespace AoScrud\Repositories\Interfaces\Methods;

interface OnSuccessInterface
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