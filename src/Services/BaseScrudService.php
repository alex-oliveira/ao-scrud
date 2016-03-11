<?php

namespace AoScrud\Services;

use AoScrud\Repositories\ScrudRepository;
use AoScrud\Utils\Traits\Transactions;

abstract class BaseScrudService
{

    /**
     * @var ScrudRepository
     */
    protected $rep;

    use Transactions;

}