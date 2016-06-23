<?php

namespace AoScrud\Repositories\Interfaces\Repositories;

use AoScrud\Repositories\Interfaces\Methods\ColumnsInterface;
use AoScrud\Repositories\Interfaces\Methods\CriteriaInterface;
use AoScrud\Repositories\Interfaces\Methods\DataInterface;
use AoScrud\Repositories\Interfaces\Methods\KeysInterface;
use AoScrud\Repositories\Interfaces\Methods\LimitInterface;
use AoScrud\Repositories\Interfaces\Methods\OnPrepareEndInterface;
use AoScrud\Repositories\Interfaces\Methods\OnPrepareErrorInterface;
use AoScrud\Repositories\Interfaces\Methods\OnPrepareInterface;
use AoScrud\Repositories\Interfaces\Methods\OrdersInterface;
use AoScrud\Repositories\Interfaces\Methods\OtherColumnsInterface;
use AoScrud\Repositories\Interfaces\Methods\RulesInterface;
use AoScrud\Repositories\Interfaces\Methods\TotalInterface;
use AoScrud\Repositories\Interfaces\Methods\WithInterface;
use AoScrud\Repositories\Interfaces\Methods\OnErrorInterface;
use AoScrud\Repositories\Interfaces\Methods\OnExecuteEndInterface;
use AoScrud\Repositories\Interfaces\Methods\OnExecuteErrorInterface;
use AoScrud\Repositories\Interfaces\Methods\OnExecuteInterface;
use AoScrud\Repositories\Interfaces\Methods\OnSuccessInterface;

interface SearchRepositoryInterface extends
    KeysInterface,
    DataInterface,
    ColumnsInterface,
    OtherColumnsInterface,
    RulesInterface,
    OrdersInterface,
    CriteriaInterface,
    WithInterface,
    TotalInterface,
    LimitInterface,
    OnPrepareInterface,
    OnPrepareEndInterface,
    OnPrepareErrorInterface,
    OnExecuteInterface,
    OnExecuteEndInterface,
    OnExecuteErrorInterface,
    OnSuccessInterface,
    OnErrorInterface
{

}