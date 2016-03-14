<?php

namespace AoScrud\Services\Except;

use AoScrud\Services\BaseScrudService;
use AoScrud\Services\Resources\Search;
use AoScrud\Services\Resources\Create;
use AoScrud\Services\Resources\Read;
use AoScrud\Services\Resources\Update;

abstract class ExceptDestroyService extends BaseScrudService
{

    use Search, Create, Read, Update;

}