<?php

namespace AoScrud\Repositories\Interfaces\Repositories;

use AoScrud\Repositories\Interfaces\Methods\ColumnsInterface;
use AoScrud\Repositories\Interfaces\Methods\RulesInterface;
use AoScrud\Repositories\Interfaces\Methods\DataInterface;

interface CreateRepositoryInterface extends ColumnsInterface, RulesInterface, DataInterface
{

}