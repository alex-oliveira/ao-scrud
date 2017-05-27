<?php

namespace AoScrud\Traits;

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

        if ($this->onExecuteError instanceof \Closure)
            $closure = $this->onExecuteError;

        elseif ($this->onError instanceof \Closure)
            $closure = $this->onError;

        is_null($closure) ? null : $closure($this, $e);
    }

}