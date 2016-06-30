<?php

namespace AoScrud\Interfaces\Repositories;

use AoScrud\Utils\Interfaces\Traits\ColumnsInterface;
use AoScrud\Utils\Interfaces\Traits\CriteriaInterface;
use AoScrud\Utils\Interfaces\Traits\DataInterface;
use AoScrud\Utils\Interfaces\Traits\KeysInterface;
use AoScrud\Utils\Interfaces\Traits\LimitInterface;
use AoScrud\Utils\Interfaces\Traits\OnPrepareEndInterface;
use AoScrud\Utils\Interfaces\Traits\OnPrepareErrorInterface;
use AoScrud\Utils\Interfaces\Traits\OnPrepareInterface;
use AoScrud\Utils\Interfaces\Traits\OrdersInterface;
use AoScrud\Utils\Interfaces\Traits\OtherColumnsInterface;
use AoScrud\Utils\Interfaces\Traits\RulesInterface;
use AoScrud\Utils\Interfaces\Traits\TotalInterface;
use AoScrud\Utils\Interfaces\Traits\WithInterface;
use AoScrud\Utils\Interfaces\Traits\OnErrorInterface;
use AoScrud\Utils\Interfaces\Traits\OnExecuteEndInterface;
use AoScrud\Utils\Interfaces\Traits\OnExecuteErrorInterface;
use AoScrud\Utils\Interfaces\Traits\OnExecuteInterface;
use AoScrud\Utils\Interfaces\Traits\OnSuccessInterface;

interface SearchRepositoryInterface extends
    DataInterface,
    KeysInterface,
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