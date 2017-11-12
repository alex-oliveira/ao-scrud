<?php

namespace AoScrud\Services\Resources\Interfaces;

use AoScrud\Services\Configurators\DestroyConfigurator;

interface IDestroyResource
{

    /**
     * @param array $data
     * @return bool
     */
    public function destroy(array $data);

    /**
     * @return DestroyConfigurator
     */
    public function destroyConfig();

}