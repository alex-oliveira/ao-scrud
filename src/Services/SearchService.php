<?php

namespace AoScrud\Services;

use AoScrud\Services\Resources\Show\Show;
use AoScrud\Services\Resources\Search\Search;

abstract class SearchService extends BaseService
{

    use Search, Show;

}