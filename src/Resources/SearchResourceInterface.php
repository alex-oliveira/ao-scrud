<?php

namespace AoScrud\Resources;

use AoScrud\Configs\SearchConfig;

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