<?php

namespace AoScrud\Services\Resources\Interfaces;

use AoScrud\Services\Configurators\UpdateConfigurator;

interface IUpdateResource
{

    /**
     * @param array $data
     * @return bool
     */
    public function update(array $data);

    /**
     * @return UpdateConfigurator
     */
    public function updateConfig();

}