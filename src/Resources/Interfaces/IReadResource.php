<?php

namespace AoScrud\Resources\Interfaces;

use AoScrud\Configs\ReadConfig;

interface IReadResource
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