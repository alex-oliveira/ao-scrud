<?php

namespace AoScrud\Services\Resources\Interfaces;

use AoScrud\Services\Configurators\SearchConfigurator;

interface ISearchResource
{

    /**
     * @param array $data
     * @return mixed
     */
    public function search(array $data);

    /**
     * @return SearchConfigurator
     */
    public function searchConfig();

}