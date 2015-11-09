<?php

namespace AoScrud\Controllers\Site\Traits;

use AoScrud\Repositories\FullRepository;

trait BaseTrait
{
    /**
     * Prefix to route names.
     *
     * @var string
     */
    protected $routes = '';

    /**
     * Prefix to views names.
     *
     * @var string
     */
    protected $views = '';

    /**
     * Prefix to lang name.
     *
     * @var string
     */
    protected $lang = '';

    /**
     * The main repository.
     *
     * @var FullRepository;
     */
    protected $repository;

}
