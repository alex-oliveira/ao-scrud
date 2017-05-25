<?php

namespace AoScrud\Traits;

trait OnPrepareError
{

    /**
     * @var \Closure
     */
    protected $onPrepareError = null;

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onPrepareError(\Closure $closure)
    {
        $this->onPrepareError = $closure;
        return $this;
    }

    /**
     * @param \Exception $e
     */
    public function triggerOnPrepareError(\Exception $e)
    {
        $closure = null;

        if (!is_null($this->onPrepareError)) {
            $closure = $this->onPrepareError;
        } elseif (!is_null($this->onError)) {
            $closure = $this->onError;
        }

        is_null($closure) ? null : $closure($this, $e);
    }

}