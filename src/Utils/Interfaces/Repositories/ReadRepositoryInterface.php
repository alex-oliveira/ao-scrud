<?php

namespace AoScrud\Interfaces\Repositories;

use AoScrud\Utils\Interfaces\Traits\ColumnsInterface;
use AoScrud\Utils\Interfaces\Traits\CriteriaInterface;
use AoScrud\Utils\Interfaces\Traits\DataInterface;
use AoScrud\Utils\Interfaces\Traits\KeysInterface;
use AoScrud\Utils\Interfaces\Traits\ObjInterface;
use AoScrud\Utils\Interfaces\Traits\OnPrepareEndInterface;
use AoScrud\Utils\Interfaces\Traits\OnPrepareErrorInterface;
use AoScrud\Utils\Interfaces\Traits\OnPrepareInterface;
use AoScrud\Utils\Interfaces\Traits\OtherColumnsInterface;
use AoScrud\Utils\Interfaces\Traits\SelectInterface;
use AoScrud\Utils\Interfaces\Traits\WithInterface;
use AoScrud\Utils\Interfaces\Traits\OnErrorInterface;
use AoScrud\Utils\Interfaces\Traits\OnExecuteEndInterface;
use AoScrud\Utils\Interfaces\Traits\OnExecuteErrorInterface;
use AoScrud\Utils\Interfaces\Traits\OnExecuteInterface;
use AoScrud\Utils\Interfaces\Traits\OnSuccessInterface;

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