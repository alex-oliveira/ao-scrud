<?php

namespace AoScrud\Controllers\Rest;

use AoScrud\Actions\Rest\Destroy;
use AoScrud\Actions\Rest\Index;
use AoScrud\Actions\Rest\Show;
use AoScrud\Actions\Rest\Store;
use AoScrud\Actions\Rest\Update;
use AoScrud\Controllers\BaseController;

class ScrudController extends BaseController
{

    use Index, Show, Store, Update, Destroy;

}
