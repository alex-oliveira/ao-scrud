<?php

namespace AoScrud\Services\Configs;

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
        if ($this->onExecute instanceof \Closure) {
            $closure = $this->onExecute;
            $closure($this);
        }
    }

}