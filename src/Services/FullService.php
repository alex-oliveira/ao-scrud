<?php

namespace AoScrud\Services;

use AoScrud\Services\Resources\Create\Create;
use AoScrud\Services\Resources\Destroy\Destroy;
use AoScrud\Services\Resources\Update\Update;

abstract class FullService extends SearchService
{

    use Create, Update, Destroy;

}