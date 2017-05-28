<?php

namespace AoScrud\Resources\Interfaces;

use AoScrud\Configs\DestroyConfig;

interface IDestroyResource
{

    /**
     * @param array $data
     * @return bool
     */
    public function destroy(array $data);

    /**
     * @return DestroyConfig
     */
    public function destroyConfig();

}