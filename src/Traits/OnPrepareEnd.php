<?php

namespace AoScrud\Traits;

trait OnPrepareEnd
{

    /**
     * @var \Closure
     */
    protected $onPrepareEnd = null;

    /**
     * @param \Closure $closure
     * @return $this
     */
    public function onPrepareEnd(\Closure $closure)
    {
        $this->onPrepareEnd = $closure;
        return $this;
    }

    public function triggerOnPrepareEnd()
    {
        $closure = $this->onPrepareEnd;
        is_null($closure) ? null : $closure($this);
    }

}