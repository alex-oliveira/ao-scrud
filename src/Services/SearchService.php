<?php

namespace AoScrud\Services;

use AoScrud\Services\Resources\Read\Read;
use AoScrud\Services\Resources\Search\Search;

abstract class SearchService extends BaseService
{

    use Search, Read;

}