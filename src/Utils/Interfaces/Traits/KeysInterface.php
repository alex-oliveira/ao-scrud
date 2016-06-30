<?php

namespace AoScrud\Utils\Interfaces\Traits;

interface KeysInterface
{

    /**
     * @param array|null $keys
     * @return $this|array
     */
    public function keys(array $keys = null);

    /**
     * @return array
     */
    public function getKeys();

    /**
     * @param array $keys
     * @return $this
     */
    public function setKeys(array $keys);

}