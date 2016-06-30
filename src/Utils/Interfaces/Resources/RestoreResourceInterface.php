<?php

namespace AoScrud\Utils\Interfaces\Resources;

use AoScrud\Services\Configs\RestoreConfig;

interface RestoreResourceInterface
{

    /**
     * @param array $data
     * @return bool
     */
    public function restore(array $data);

    /**
     * @return RestoreConfig
     *
     */
    public function restoreConfig();

}