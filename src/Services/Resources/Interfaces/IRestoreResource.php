<?php

namespace AoScrud\Services\Resources\Interfaces;

use AoScrud\Services\Configurators\RestoreConfigurator;

interface IRestoreResource
{

    /**
     * @param array $data
     * @return bool
     */
    public function restore(array $data);

    /**
     * @return RestoreConfigurator
     */
    public function restoreConfig();

}