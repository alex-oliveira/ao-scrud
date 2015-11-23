<?php

namespace AoScrud\Controllers\Rest;

use AoScrud\Services\FullService;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{

    /**
     * The main repository.
     *
     * @var FullService
     */
    protected $service;

    /**
     * @var string
     */
    protected $main = 'home';

    /**
     * @var string
     */
    protected $routes = '';

    /**
     * @var string
     */
    protected $views = 'ao-scrud::controllers';

    /**
     * @var string
     */
    protected $langs = 'ao-scrud::controllers';

}