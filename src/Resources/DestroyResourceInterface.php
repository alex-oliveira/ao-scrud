<?php

namespace AoScrud\Resources;

use AoScrud\Configs\DestroyConfig;

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