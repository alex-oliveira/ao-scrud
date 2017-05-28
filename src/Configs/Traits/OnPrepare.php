<?php

namespace AoScrud\Configs\Traits;

trait OnPrepare
{

    /**
     * @var \Closure
     */
    protected $onPrepare = null;

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onPrepare(\Closure $closure)
    {
        $this->onPrepare = $closure;
        return $this;
    }

    public function triggerOnPrepare()
    {
        if ($this->onPrepare instanceof \Closure) {
            $closure = $this->onPrepare;
            $closure($this);
        }
    }

}