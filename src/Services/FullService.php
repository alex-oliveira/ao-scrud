<?php

namespace AoScrud\Services;

use AoScrud\Services\Resources\Search\Search;
use AoScrud\Services\Resources\Create\Create;
use AoScrud\Services\Resources\Read\Read;
use AoScrud\Services\Resources\Update\Update;
use AoScrud\Services\Resources\Destroy\Destroy;

abstract class FullService extends BaseService
{

    use Search, Create, Read, Update, Destroy;

}