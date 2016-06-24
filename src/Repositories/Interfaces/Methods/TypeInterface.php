<?php

namespace AoScrud\Repositories\Interfaces\Methods;

interface TypeInterface
{

    /**
     * @param int|null $type
     * @return $this|int
     */
    public function type($type = null);

    /**
     * @return int
     */
    public function getType();

    /**
     * @param int $type
     * @return $this
     */
    public function setType($type);

}