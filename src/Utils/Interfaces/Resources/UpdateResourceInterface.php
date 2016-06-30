<?php

namespace AoScrud\Utils\Interfaces\Resources;

use AoScrud\Services\Configs\UpdateConfig;

interface UpdateResourceInterface
{

    /**
     * @param array $data
     * @return bool
     */
    public function update(array $data);

    /**
     * @return UpdateConfig
     */
    public function updateConfig();

}