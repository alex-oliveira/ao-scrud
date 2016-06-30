<?php

namespace AoScrud\Services;

use AoScrud\Services\Configs\CreateConfig;
use AoScrud\Services\Configs\DestroyConfig;
use AoScrud\Services\Configs\ReadConfig;
use AoScrud\Services\Configs\RestoreConfig;
use AoScrud\Services\Configs\SearchConfig;
use AoScrud\Services\Configs\UpdateConfig;
use AoScrud\Services\Resources\Create;
use AoScrud\Services\Resources\Destroy;
use AoScrud\Services\Resources\Read;
use AoScrud\Services\Resources\Update;
use AoScrud\Services\Resources\Search;
use AoScrud\Services\Resources\Restore;
use AoScrud\Utils\Interfaces\Resources\CreateResourceInterface;
use AoScrud\Utils\Interfaces\Resources\DestroyResourceInterface;
use AoScrud\Utils\Interfaces\Resources\ReadResourceInterface;
use AoScrud\Utils\Interfaces\Resources\RestoreResourceInterface;
use AoScrud\Utils\Interfaces\Resources\SearchResourceInterface;
use AoScrud\Utils\Interfaces\Resources\UpdateResourceInterface;

class ScrudService implements SearchResourceInterface, CreateResourceInterface, ReadResourceInterface,
    UpdateResourceInterface, DestroyResourceInterface, RestoreResourceInterface
{

    use Search, Create, Read, Update, Destroy, Restore;

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