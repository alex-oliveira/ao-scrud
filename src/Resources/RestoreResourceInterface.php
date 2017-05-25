<?php

namespace AoScrud\Resources;

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