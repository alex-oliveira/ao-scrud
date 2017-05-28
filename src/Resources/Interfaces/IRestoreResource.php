<?php

namespace AoScrud\Resources\Interfaces;

use AoScrud\Configs\RestoreConfig;

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