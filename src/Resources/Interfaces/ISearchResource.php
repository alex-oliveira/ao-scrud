<?php

namespace AoScrud\Resources\Interfaces;

use AoScrud\Configs\SearchConfig;

interface ISearchResource
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