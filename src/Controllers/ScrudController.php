<?php

namespace AoScrud\Controllers;

use AoScrud\Actions\Destroy;
use AoScrud\Actions\Index;
use AoScrud\Actions\Show;
use AoScrud\Actions\Store;
use AoScrud\Actions\Update;
use AoScrud\Actions\Restore;

class ScrudController extends BaseScrudController
{

    use Index, Show, Store, Update, Destroy, Restore;

}
