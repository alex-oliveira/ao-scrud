<?php

namespace AoScrud\Repositories\Traits;

trait OnExecuteError
{

    /**
     * @var \Closure
     */
    protected $onExecuteError = null;

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onExecuteError(\Closure $closure)
    {
        $this->onExecuteError = $closure;
        return $this;
    }

    /**
     * @param \Exception $e
     */
    public function triggerOnExecuteError(\Exception $e)
    {
        $closure = null;

        if (!is_null($this->onExecuteError)) {
            $closure = $this->onExecuteError;
        } elseif (!is_null($this->onError)) {
            $closure = $this->onError;
        }

        is_null($closure) ? null : $closure($this, $e);
    }

}