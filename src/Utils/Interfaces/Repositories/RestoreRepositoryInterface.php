<?php

namespace AoScrud\Interfaces\Repositories;

use AoScrud\Utils\Interfaces\Traits\DataInterface;
use AoScrud\Utils\Interfaces\Traits\KeysInterface;
use AoScrud\Utils\Interfaces\Traits\OnErrorInterface;
use AoScrud\Utils\Interfaces\Traits\OnExecuteEndInterface;
use AoScrud\Utils\Interfaces\Traits\OnExecuteErrorInterface;
use AoScrud\Utils\Interfaces\Traits\OnExecuteInterface;
use AoScrud\Utils\Interfaces\Traits\OnSuccessInterface;

interface RestoreRepositoryInterface extends
    DataInterface,
    KeysInterface,
    OnExecuteInterface,
    OnExecuteEndInterface,
    OnExecuteErrorInterface,
    OnSuccessInterface,
    OnErrorInterface
{

}