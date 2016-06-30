<?php

namespace AoScrud\Utils\Interfaces\Resources;

use AoScrud\Services\Configs\ReadConfig;

interface ReadResourceInterface
{

    /**
     * @param array $data
     * @return mixed
     */
    public function read(array $data);

    /**
     * @return ReadConfig
     */
    public function readConfig();

}