<?php

namespace AoScrud\Resources;

use AoScrud\Configs\UpdateConfig;

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