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

        if ($this->onPrepareError instanceof \Closure)
            $closure = $this->onPrepareError;

        elseif ($this->onError instanceof \Closure)
            $closure = $this->onError;

        is_null($closure) ? null : $closure($this, $e);
    }

}