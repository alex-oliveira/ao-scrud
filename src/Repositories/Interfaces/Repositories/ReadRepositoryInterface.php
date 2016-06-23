<?php

namespace AoScrud\Repositories\Interfaces\Repositories;

use AoScrud\Repositories\Interfaces\Methods\ColumnsInterface;
use AoScrud\Repositories\Interfaces\Methods\CriteriaInterface;
use AoScrud\Repositories\Interfaces\Methods\DataInterface;
use AoScrud\Repositories\Interfaces\Methods\KeysInterface;
use AoScrud\Repositories\Interfaces\Methods\ObjInterface;
use AoScrud\Repositories\Interfaces\Methods\OnPrepareEndInterface;
use AoScrud\Repositories\Interfaces\Methods\OnPrepareErrorInterface;
use AoScrud\Repositories\Interfaces\Methods\OnPrepareInterface;
use AoScrud\Repositories\Interfaces\Methods\OtherColumnsInterface;
use AoScrud\Repositories\Interfaces\Methods\SelectInterface;
use AoScrud\Repositories\Interfaces\Methods\WithInterface;
use AoScrud\Repositories\Interfaces\Methods\OnErrorInterface;
use AoScrud\Repositories\Interfaces\Methods\OnExecuteEndInterface;
use AoScrud\Repositories\Interfaces\Methods\OnExecuteErrorInterface;
use AoScrud\Repositories\Interfaces\Methods\OnExecuteInterface;
use AoScrud\Repositories\Interfaces\Methods\OnSuccessInterface;

interface ReadRepositoryInterface extends
    DataInterface,
    KeysInterface,
    SelectInterface,
    ObjInterface,
    ColumnsInterface,
    OtherColumnsInterface,
    CriteriaInterface,
    WithInterface,
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