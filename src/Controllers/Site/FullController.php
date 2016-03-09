<?php

namespace AoScrud\Controllers\Site;

use AoScrud\Controllers\Site\Actions\Create;
use AoScrud\Controllers\Site\Actions\Delete;
use AoScrud\Controllers\Site\Actions\Destroy;
use AoScrud\Controllers\Site\Actions\Edit;
use AoScrud\Controllers\Site\Actions\Index;
use AoScrud\Controllers\Site\Actions\Show;
use AoScrud\Controllers\Site\Actions\Store;
use AoScrud\Controllers\Site\Actions\Update;

class FullController extends SiteController
{

    use Index, Show, Create, Store, Edit, Update, Delete, Destroy;

}