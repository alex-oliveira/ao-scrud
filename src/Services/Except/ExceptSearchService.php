<?php

namespace AoScrud\Services\Except;

use AoScrud\Services\BaseScrudService;
use AoScrud\Services\Resources\Create;
use AoScrud\Services\Resources\Read;
use AoScrud\Services\Resources\Update;
use AoScrud\Services\Resources\Destroy;

abstract class ExceptSearchService extends BaseScrudService
{

    use Create, Read, Update, Destroy;

}