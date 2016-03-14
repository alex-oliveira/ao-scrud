<?php

namespace AoScrud\Services\Except;

use AoScrud\Services\BaseScrudService;
use AoScrud\Services\Resources\Search;
use AoScrud\Services\Resources\Create;
use AoScrud\Services\Resources\Read;
use AoScrud\Services\Resources\Destroy;

abstract class ExceptUpdateService extends BaseScrudService
{

    use Search, Create, Read, Destroy;

}