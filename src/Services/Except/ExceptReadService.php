<?php

namespace AoScrud\Services\Except;

use AoScrud\Services\BaseScrudService;
use AoScrud\Services\Resources\Search;
use AoScrud\Services\Resources\Create;
use AoScrud\Services\Resources\Update;
use AoScrud\Services\Resources\Destroy;

abstract class ExceptReadService extends BaseScrudService
{

    use Search, Create, Update, Destroy;

}