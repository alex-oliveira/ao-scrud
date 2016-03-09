<?php

namespace AoScrud\Controllers\Rest;

use AoScrud\Controllers\Rest\Actions\Destroy;
use AoScrud\Controllers\Rest\Actions\Index;
use AoScrud\Controllers\Rest\Actions\Show;
use AoScrud\Controllers\Rest\Actions\Store;
use AoScrud\Controllers\Rest\Actions\Update;

class FullController extends RestController
{

    use Index, Show, Store, Update, Destroy;

}