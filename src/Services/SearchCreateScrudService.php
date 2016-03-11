<?php

namespace AoScrud\Services;

use AoScrud\Services\Resources\Search;
use AoScrud\Services\Resources\Create;
use AoScrud\Services\Resources\Read;
use AoScrud\Services\Resources\Update;
use AoScrud\Services\Resources\Destroy;

abstract class SearchCreateScrudService extends BaseScrudService
{

    use Search, Create;

}