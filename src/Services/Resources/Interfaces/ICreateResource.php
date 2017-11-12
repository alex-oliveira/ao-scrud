<?php

namespace AoScrud\Services\Resources\Interfaces;

use AoScrud\Services\Configurators\CreateConfigurator;
use Illuminate\Database\Eloquent\Model;

interface ICreateResource
{

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data);

    /**
     * @return CreateConfigurator
     */
    public function createConfig();

}