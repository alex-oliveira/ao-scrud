<?php

namespace AoScrud\Repositories\Traits;

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

    protected function triggerOnPrepareEnd()
    {
        $closure = $this->onPrepareEnd;
        is_null($closure) ? null : $closure($this);
    }

}