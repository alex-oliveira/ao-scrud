<?php

namespace AoScrud\Controllers;

use AoScrud\Controllers\Actions\Destroy;
use AoScrud\Controllers\Actions\Index;
use AoScrud\Controllers\Actions\Show;
use AoScrud\Controllers\Actions\Store;
use AoScrud\Controllers\Actions\Update;
use AoScrud\Controllers\Actions\Restore;
use AoScrud\Core\ScrudService;
use Illuminate\Routing\Controller;

class AoScrudController extends Controller
{

    /**
     * @var ScrudService
     */
    protected $service;

    use Index, Show, Store, Update, Destroy, Restore;

}
