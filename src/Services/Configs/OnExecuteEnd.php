<?php

namespace AoScrud\Services\Configs;

trait OnExecuteEnd
{

    /**
     * @var \Closure
     */
    protected $onExecuteEnd = null;

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onExecuteEnd(\Closure $closure)
    {
        $this->onExecuteEnd = $closure;
        return $this;
    }

    /**
     * @param mixed $result
     */
    public function triggerOnExecuteEnd($result)
    {
        if ($this->onExecuteEnd instanceof \Closure) {
            $closure = $this->onExecuteEnd;
            $closure($this, $result);
        }
    }

}