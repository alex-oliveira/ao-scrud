<?php

namespace AoScrud\Repositories\Interfaces\Repositories;

use AoScrud\Repositories\Interfaces\Methods\KeysInterface;
use AoScrud\Repositories\Interfaces\Methods\OnErrorInterface;
use AoScrud\Repositories\Interfaces\Methods\OnExecuteEndInterface;
use AoScrud\Repositories\Interfaces\Methods\OnExecuteErrorInterface;
use AoScrud\Repositories\Interfaces\Methods\OnExecuteInterface;
use AoScrud\Repositories\Interfaces\Methods\OnSuccessInterface;

interface RestoreRepositoryInterface extends
    KeysInterface,
    OnExecuteInterface,
    OnExecuteEndInterface,
    OnExecuteErrorInterface,
    OnSuccessInterface,
    OnErrorInterface
{

}