<?php

namespace AoScrud\Repositories\Traits;

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
    protected function triggerOnExecuteEnd($result)
    {
        $closure = $this->onExecuteEnd;
        is_null($closure) ? null : $closure($this, $result);
    }

}