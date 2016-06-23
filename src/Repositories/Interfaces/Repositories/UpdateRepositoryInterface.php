<?php

namespace AoScrud\Repositories\Interfaces\Repositories;

use AoScrud\Repositories\Interfaces\Methods\ColumnsInterface;
use AoScrud\Repositories\Interfaces\Methods\DataInterface;
use AoScrud\Repositories\Interfaces\Methods\KeysInterface;
use AoScrud\Repositories\Interfaces\Methods\RulesInterface;
use AoScrud\Repositories\Interfaces\Methods\ObjInterface;
use AoScrud\Repositories\Interfaces\Methods\OnErrorInterface;
use AoScrud\Repositories\Interfaces\Methods\OnExecuteEndInterface;
use AoScrud\Repositories\Interfaces\Methods\OnExecuteErrorInterface;
use AoScrud\Repositories\Interfaces\Methods\OnExecuteInterface;
use AoScrud\Repositories\Interfaces\Methods\OnPrepareEndInterface;
use AoScrud\Repositories\Interfaces\Methods\OnPrepareErrorInterface;
use AoScrud\Repositories\Interfaces\Methods\OnPrepareInterface;
use AoScrud\Repositories\Interfaces\Methods\OnSuccessInterface;
use AoScrud\Repositories\Interfaces\Methods\SelectInterface;

interface UpdateRepositoryInterface extends
    DataInterface,
    KeysInterface,
    SelectInterface,
    ColumnsInterface,
    RulesInterface,
    ObjInterface,
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