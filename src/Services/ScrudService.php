<?php

namespace AoScrud\Services;

use AoScrud\Repositories\ScrudRepository;
use AoScrud\Services\Resources\Search;
use AoScrud\Services\Resources\Create;
use AoScrud\Services\Resources\Read;
use AoScrud\Services\Resources\Update;
use AoScrud\Services\Resources\Destroy;
use AoScrud\Utils\Traits\Transactions;

abstract class ScrudService
{

    /**
     * @var ScrudRepository
     */
    protected $rep;

    //------------------------------------------------------------------------------------------------------------------

    use Transactions, Search, Create, Read, Update, Destroy;

}