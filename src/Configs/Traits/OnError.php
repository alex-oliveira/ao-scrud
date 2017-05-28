<?php

namespace AoScrud\Traits;

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
    public function triggerOnError(\Exception $e)
    {
        if ($this->onError instanceof \Closure) {
            $closure = $this->onError;
            $closure($this, $e);
        }
    }

}