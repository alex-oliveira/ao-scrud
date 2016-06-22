<?php

namespace AoScrud\Repositories\Traits;

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
        $closure = $this->onPrepare;
        is_null($closure) ? null : $closure($this);
    }

}