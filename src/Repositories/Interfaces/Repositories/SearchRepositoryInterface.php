<?php

namespace AoScrud\Repositories\Interfaces\Repositories;

use AoScrud\Repositories\Interfaces\Methods\ColumnsInterface;
use AoScrud\Repositories\Interfaces\Methods\CriteriaInterface;
use AoScrud\Repositories\Interfaces\Methods\LimitInterface;
use AoScrud\Repositories\Interfaces\Methods\OrdersInterface;
use AoScrud\Repositories\Interfaces\Methods\OtherColumnsInterface;
use AoScrud\Repositories\Interfaces\Methods\RouteParamsInterface;
use AoScrud\Repositories\Interfaces\Methods\RulesInterface;
use AoScrud\Repositories\Interfaces\Methods\TotalInterface;
use AoScrud\Repositories\Interfaces\Methods\WithInterface;

interface SearchRepositoryInterface extends ColumnsInterface, OtherColumnsInterface, CriteriaInterface, LimitInterface,
    OrdersInterface, RouteParamsInterface, RulesInterface, TotalInterface, WithInterface
{

}