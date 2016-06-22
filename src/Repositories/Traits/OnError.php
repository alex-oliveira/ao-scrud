<?php

namespace AoScrud\Repositories\Traits;

trait OnError
{

    /**
     * @var \Closure
     */
    protected $onError = null;

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onError(\Closure $closure)
    {
        $this->onError = $closure;
        return $this;
    }

    /**
     * @param \Exception $e
     */
    protected function triggerOnError(\Exception $e)
    {
        $closure = $this->onError;
        is_null($closure) ? null : $closure($this, $e);
    }

}