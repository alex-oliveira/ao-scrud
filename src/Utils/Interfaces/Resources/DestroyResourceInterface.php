<?php

namespace AoScrud\Utils\Interfaces\Resources;

use AoScrud\Services\Configs\DestroyConfig;

interface DestroyResourceInterface
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