<?php

namespace AoScrud;

use AoScrud\Actions\Destroy;
use AoScrud\Actions\Index;
use AoScrud\Actions\Show;
use AoScrud\Actions\Store;
use AoScrud\Actions\Update;
use AoScrud\Actions\Restore;
use AoScrud\Services\ScrudService;
use Illuminate\Routing\Controller;

class ScrudController extends Controller
{

    /**
     * @var ScrudService
     */
    protected $service;

    use Index, Show, Store, Update, Destroy, Restore;

}
