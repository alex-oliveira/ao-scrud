<?php

namespace AoScrud\Resources\Interfaces;

use AoScrud\Configs\CreateConfig;
use Illuminate\Database\Eloquent\Model;

interface ICreateResource
{

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data);

    /**
     * @return CreateConfig
     */
    public function createConfig();

}