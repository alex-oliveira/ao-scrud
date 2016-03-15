<?php

namespace AoScrud\Services;

use AoScrud\Services\Resources\Create;
use AoScrud\Services\Resources\Destroy;
use AoScrud\Services\Resources\Read;
use AoScrud\Services\Resources\Search;
use AoScrud\Services\Resources\Update;

abstract class FullScrudService extends ScrudService
{

    use Search, Create, Read, Update, Destroy;

}