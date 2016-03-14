<?php

namespace AoScrud\Services\Only;

use AoScrud\Services\BaseScrudService;
use AoScrud\Services\Resources\Search;
use AoScrud\Services\Resources\Create;

abstract class OnlySearchCreateService extends BaseScrudService
{

    use Search, Create;

}