<?php

namespace AoScrud\Services;

use AoScrud\Services\Resources\Search;
use AoScrud\Services\Resources\Create;
use AoScrud\Services\Resources\Read;
use AoScrud\Services\Resources\Update;
use AoScrud\Services\Resources\Destroy;
use AoScrud\Util\Traits\Transactions;
use Prettus\Repository\Eloquent\BaseRepository;

abstract class ScrudService
{

    use Transactions, Search, Create, Read, Update, Destroy;

    //------------------------------------------------------------------------------------------------------------------

    /**
     * @var BaseRepository
     */
    protected $rep;

    /**
     * @return \Illuminate\Support\Collection
     */
    public static function params()
    {
        return collect(array_merge(request()->all(), request()->route()->parameters()));
    }

}