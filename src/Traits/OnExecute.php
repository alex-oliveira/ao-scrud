<?php

namespace AoScrud\Traits;

trait OnExecute
{

    /**
     * @var \Closure
     */
    protected $onExecute = null;

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onExecute(\Closure $closure)
    {
        $this->onExecute = $closure;
        return $this;
    }

    public function triggerOnExecute()
    {
        $closure = $this->onExecute;
        is_null($closure) ? null : $closure($this);
    }

}