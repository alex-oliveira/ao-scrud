<?php

namespace AoScrud\Services\Resources\Interfaces;

use AoScrud\Services\Configurators\ReadConfigurator;

interface IReadResource
{

    /**
     * @param array $data
     * @return mixed
     */
    public function read(array $data);

    /**
     * @return ReadConfigurator
     */
    public function readConfig();

}