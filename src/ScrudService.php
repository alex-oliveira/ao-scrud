<?php

namespace AoScrud;

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
use AoScrud\Resources\CreateResourceInterface;
use AoScrud\Resources\DestroyResourceInterface;
use AoScrud\Resources\ReadResourceInterface;
use AoScrud\Resources\RestoreResourceInterface;
use AoScrud\Resources\SearchResourceInterface;
use AoScrud\Resources\UpdateResourceInterface;

class ScrudService implements
    SearchResourceInterface, CreateResourceInterface, ReadResourceInterface, UpdateResourceInterface, DestroyResourceInterface, RestoreResourceInterface
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