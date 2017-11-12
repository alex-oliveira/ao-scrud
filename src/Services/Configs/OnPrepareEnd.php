<?php

namespace AoScrud\Services\Configs;

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
        if ($this->onPrepareEnd instanceof \Closure) {
            $closure = $this->onPrepareEnd;
            $closure($this);
        }
    }

}