<?php

namespace AoScrud\Services;

use AoScrud\Services\Resources\Search\Search;
use AoScrud\Services\Resources\Read\Read;

abstract class SearchService extends BaseService
{

    use Search, Read;

}