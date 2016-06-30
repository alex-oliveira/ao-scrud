<?php

namespace AoScrud\Utils\Interfaces\Resources;

use AoScrud\Services\Configs\SearchConfig;

interface SearchResourceInterface
{

    /**
     * @param array $data
     * @return mixed
     */
    public function search(array $data);

    /**
     * @return SearchConfig
     */
    public function searchConfig();

}