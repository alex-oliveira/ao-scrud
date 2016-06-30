<?php

namespace AoScrud\Interfaces\Repositories;

use AoScrud\Utils\Interfaces\Traits\BlockInterface;
use AoScrud\Utils\Interfaces\Traits\CascadeInterface;
use AoScrud\Utils\Interfaces\Traits\DataInterface;
use AoScrud\Utils\Interfaces\Traits\DissociateInterface;
use AoScrud\Utils\Interfaces\Traits\KeysInterface;
use AoScrud\Utils\Interfaces\Traits\OnErrorInterface;
use AoScrud\Utils\Interfaces\Traits\OnExecuteEndInterface;
use AoScrud\Utils\Interfaces\Traits\OnExecuteErrorInterface;
use AoScrud\Utils\Interfaces\Traits\OnExecuteInterface;
use AoScrud\Utils\Interfaces\Traits\OnSuccessInterface;
use AoScrud\Utils\Interfaces\Traits\SoftInterface;
use AoScrud\Utils\Interfaces\Traits\TitleInterface;
use AoScrud\Utils\Interfaces\Traits\TypeInterface;

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