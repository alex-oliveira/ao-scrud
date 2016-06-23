<?php

namespace AoScrud\Repositories\Traits;

trait Keys
{

    /**
     * @var array
     */
    protected $keys = ['id'];

    /**
     * @param array|null $keys
     * @return $this|array
     */
    public function keys(array $keys = null)
    {
        if (is_null($keys))
            return $this->getKeys();
        return $this->setKeys($keys);
    }

    /**
     * @return array
     */
    public function getKeys()
    {
        return $this->keys;
    }

    /**
     * @param array $keys
     * @return $this
     */
    public function setKeys(array $keys)
    {
        $this->keys = $keys;
        return $this;
    }

}