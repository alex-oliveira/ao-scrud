<?php

namespace AoScrud\Configs\Traits;

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
        if ($this->onSuccess instanceof \Closure) {
            $closure = $this->onSuccess;
            return $closure($this, $result);
        }

        return $result;
    }

}