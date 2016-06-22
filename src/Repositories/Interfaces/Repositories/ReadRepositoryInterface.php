<?php

namespace AoScrud\Repositories\Interfaces\Repositories;

use AoScrud\Repositories\Interfaces\Methods\ColumnsInterface;
use AoScrud\Repositories\Interfaces\Methods\CriteriaInterface;
use AoScrud\Repositories\Interfaces\Methods\RouteParamsInterface;
use AoScrud\Repositories\Interfaces\Methods\WithInterface;

interface ReadRepositoryInterface extends ColumnsInterface, CriteriaInterface, RouteParamsInterface, WithInterface
{

}