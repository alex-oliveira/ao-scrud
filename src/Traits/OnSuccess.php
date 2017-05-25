<?php

namespace AoScrud\Traits;

trait OnSuccess
{

    /**
     * @var \Closure
     */
    protected $onSuccess = null;

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onSuccess(\Closure $closure)
    {
        $this->onSuccess = $closure;
        return $this;
    }

    /**
     * @param mixed $result
     * @return mixed
     */
    public function triggerOnSuccess($result)
    {
        $closure = $this->onSuccess;
        return is_null($closure) ? $result : $closure($this, $result);
    }

}