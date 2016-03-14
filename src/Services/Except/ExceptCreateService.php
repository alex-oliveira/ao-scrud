<?php

namespace AoScrud\Services\Except;

use AoScrud\Services\BaseScrudService;
use AoScrud\Services\Resources\Search;
use AoScrud\Services\Resources\Read;
use AoScrud\Services\Resources\Update;
use AoScrud\Services\Resources\Destroy;

abstract class ExceptCreateService extends BaseScrudService
{

    use Search, Read, Update, Destroy;

}