<?php

namespace AoScrud\Repositories\Traits;

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
    protected function triggerOnSuccess($result)
    {
        $closure = $this->onSuccess;

        if (is_null($closure))
            return $result;

        return $closure($this, $result);
    }

}