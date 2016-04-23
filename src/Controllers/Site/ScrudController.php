<?php

namespace AoScrud\Controllers\Site;

use AoScrud\Actions\Site\Create;
use AoScrud\Actions\Site\Delete;
use AoScrud\Actions\Site\Destroy;
use AoScrud\Actions\Site\Edit;
use AoScrud\Actions\Site\Index;
use AoScrud\Actions\Site\Show;
use AoScrud\Actions\Site\Store;
use AoScrud\Actions\Site\Update;
use AoScrud\Controllers\BaseController;

class ScrudController extends BaseController
{

    use Index, Show, Create, Store, Edit, Update, Delete, Destroy;

    /**
     * @var string
     */
    protected $views = 'ao-scrud::controllers';

    /**
     * @var string
     */
    protected $langs = 'ao-scrud::controllers';

    /**
     * @var string
     */
    protected $main = 'home';

    /**
     * @var string
     */
    protected $routes = '';

}