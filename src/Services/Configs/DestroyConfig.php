<?php

namespace AoScrud\Services\Configs;

use AoScrud\Utils\Interfaces\Traits\BlockInterface;
use AoScrud\Utils\Interfaces\Traits\CascadeInterface;
use AoScrud\Utils\Interfaces\Traits\DataInterface;
use AoScrud\Utils\Interfaces\Traits\DissociateInterface;
use AoScrud\Utils\Interfaces\Traits\KeysInterface;
use AoScrud\Utils\Interfaces\Traits\ModelInterface;
use AoScrud\Utils\Interfaces\Traits\ObjInterface;
use AoScrud\Utils\Interfaces\Traits\SelectInterface;
use AoScrud\Utils\Interfaces\Traits\SoftInterface;
use AoScrud\Utils\Interfaces\Traits\TitleInterface;
use AoScrud\Utils\Interfaces\Traits\TypeInterface;
use AoScrud\Utils\Traits\Block;
use AoScrud\Utils\Traits\Cascade;
use AoScrud\Utils\Traits\Data;
use AoScrud\Utils\Traits\Dissociate;
use AoScrud\Utils\Traits\Keys;
use AoScrud\Utils\Traits\Model;
use AoScrud\Utils\Traits\Obj;
use AoScrud\Utils\Traits\OnError;
use AoScrud\Utils\Traits\OnExecute;
use AoScrud\Utils\Traits\OnExecuteEnd;
use AoScrud\Utils\Traits\OnExecuteError;
use AoScrud\Utils\Traits\OnPrepare;
use AoScrud\Utils\Traits\OnPrepareEnd;
use AoScrud\Utils\Traits\OnPrepareError;
use AoScrud\Utils\Traits\OnSuccess;
use AoScrud\Utils\Traits\Select;
use AoScrud\Utils\Traits\Soft;
use AoScrud\Utils\Traits\Title;
use AoScrud\Utils\Traits\Type;

class DestroyConfig implements ModelInterface, DataInterface, KeysInterface, TitleInterface, SelectInterface,
    ObjInterface, BlockInterface, CascadeInterface, DissociateInterface, SoftInterface, TypeInterface
{

    use Model, Data, Keys, Title, Select, Obj, Block, Cascade, Dissociate, Soft, Type;
    use OnPrepare, OnPrepareEnd, OnPrepareError, OnExecute, OnExecuteEnd, OnExecuteError, OnSuccess, OnError;

}