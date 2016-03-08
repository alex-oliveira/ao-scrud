<?php

namespace AoScrud\Services;

use AoScrud\Services\Resources\Show\Show;
use AoScrud\Services\Resources\Search\Search;
use AoScrud\Services\Resources\Create\Create;
use AoScrud\Services\Resources\Destroy\Destroy;
use AoScrud\Services\Resources\Update\Update;

abstract class FullService extends BaseService
{

    use Search, Show, Create, Update, Destroy;

}