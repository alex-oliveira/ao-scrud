<?php

namespace AoScrud\Services;

use AoScrud\Services\Configurators\CreateConfigurator;
use AoScrud\Services\Configurators\DestroyConfigurator;
use AoScrud\Services\Configurators\ReadConfigurator;
use AoScrud\Services\Configurators\RestoreConfigurator;
use AoScrud\Services\Configurators\SearchConfigurator;
use AoScrud\Services\Configurators\UpdateConfigurator;
use AoScrud\Services\Resources\CreateResource;
use AoScrud\Services\Resources\DestroyResource;
use AoScrud\Services\Resources\ReadResource;
use AoScrud\Services\Resources\UpdateResource;
use AoScrud\Services\Resources\SearchResource;
use AoScrud\Services\Resources\RestoreResource;
use AoScrud\Services\Resources\Interfaces\ICreateResource;
use AoScrud\Services\Resources\Interfaces\IDestroyResource;
use AoScrud\Services\Resources\Interfaces\IReadResource;
use AoScrud\Services\Resources\Interfaces\IRestoreResource;
use AoScrud\Services\Resources\Interfaces\ISearchResource;
use AoScrud\Services\Resources\Interfaces\IUpdateResource;

class AoScrudService implements ISearchResource, ICreateResource, IReadResource, IUpdateResource, IDestroyResource, IRestoreResource
{

    use SearchResource, CreateResource, ReadResource, UpdateResource, DestroyResource, RestoreResource;

    public function __construct()
    {
        $this->search = app()->make(SearchConfigurator::class);
        $this->create = app()->make(CreateConfigurator::class);
        $this->read = app()->make(ReadConfigurator::class);
        $this->update = app()->make(UpdateConfigurator::class);
        $this->destroy = app()->make(DestroyConfigurator::class);
        $this->restore = app()->make(RestoreConfigurator::class);
    }

}