<?php

namespace AoScrud\Utils\Interfaces\Resources;

use AoScrud\Services\Configs\CreateConfig;
use Illuminate\Database\Eloquent\Model;

interface CreateResourceInterface
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