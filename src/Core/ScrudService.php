<?php

namespace AoScrud\Core;

use AoScrud\Configs\CreateConfig;
use AoScrud\Configs\DestroyConfig;
use AoScrud\Configs\ReadConfig;
use AoScrud\Configs\RestoreConfig;
use AoScrud\Configs\SearchConfig;
use AoScrud\Configs\UpdateConfig;
use AoScrud\Resources\CreateResource;
use AoScrud\Resources\DestroyResource;
use AoScrud\Resources\ReadResource;
use AoScrud\Resources\UpdateResource;
use AoScrud\Resources\SearchResource;
use AoScrud\Resources\RestoreResource;
use AoScrud\Resources\Interfaces\ICreateResource;
use AoScrud\Resources\Interfaces\IDestroyResource;
use AoScrud\Resources\Interfaces\IReadResource;
use AoScrud\Resources\Interfaces\IRestoreResource;
use AoScrud\Resources\Interfaces\ISearchResource;
use AoScrud\Resources\Interfaces\IUpdateResource;

class ScrudService implements ISearchResource, ICreateResource, IReadResource, IUpdateResource, IDestroyResource, IRestoreResource
{

    use SearchResource, CreateResource, ReadResource, UpdateResource, DestroyResource, RestoreResource;

    public function __construct()
    {
        $this->search = app()->make(SearchConfig::class);
        $this->create = app()->make(CreateConfig::class);
        $this->read = app()->make(ReadConfig::class);
        $this->update = app()->make(UpdateConfig::class);
        $this->destroy = app()->make(DestroyConfig::class);
        $this->restore = app()->make(RestoreConfig::class);
    }

}