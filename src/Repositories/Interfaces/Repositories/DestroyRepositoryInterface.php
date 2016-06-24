<?php

namespace AoScrud\Repositories\Interfaces\Repositories;

use AoScrud\Repositories\Interfaces\Methods\BlockInterface;
use AoScrud\Repositories\Interfaces\Methods\CascadeInterface;
use AoScrud\Repositories\Interfaces\Methods\DataInterface;
use AoScrud\Repositories\Interfaces\Methods\DissociateInterface;
use AoScrud\Repositories\Interfaces\Methods\KeysInterface;
use AoScrud\Repositories\Interfaces\Methods\OnErrorInterface;
use AoScrud\Repositories\Interfaces\Methods\OnExecuteEndInterface;
use AoScrud\Repositories\Interfaces\Methods\OnExecuteErrorInterface;
use AoScrud\Repositories\Interfaces\Methods\OnExecuteInterface;
use AoScrud\Repositories\Interfaces\Methods\OnSuccessInterface;
use AoScrud\Repositories\Interfaces\Methods\SoftInterface;
use AoScrud\Repositories\Interfaces\Methods\TitleInterface;
use AoScrud\Repositories\Interfaces\Methods\TypeInterface;

interface DestroyRepositoryInterface extends
    DataInterface,
    KeysInterface,
    TitleInterface,
    BlockInterface,
    DissociateInterface,
    CascadeInterface,
    SoftInterface,
    TypeInterface,
    OnExecuteInterface,
    OnExecuteEndInterface,
    OnExecuteErrorInterface,
    OnSuccessInterface,
    OnErrorInterface
{

}