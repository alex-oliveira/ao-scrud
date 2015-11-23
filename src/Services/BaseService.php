<?php

namespace AoScrud\Services;

use AoScrud\Repositories\ScrudRepository;
use AoScrud\Services\Resources\Transactions;

abstract class BaseService
{

    use Transactions;

    /**
     * @var ScrudRepository
     */
    protected $rep;

    public static function data()
    {
        return array_merge(request()->all(), request()->route()->parameters());
    }

}