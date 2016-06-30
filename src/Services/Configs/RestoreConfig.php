<?php

namespace AoScrud\Services\Configs;

use AoScrud\Utils\Interfaces\Traits\DataInterface;
use AoScrud\Utils\Interfaces\Traits\KeysInterface;
use AoScrud\Utils\Interfaces\Traits\ModelInterface;
use AoScrud\Utils\Interfaces\Traits\ObjInterface;
use AoScrud\Utils\Interfaces\Traits\SelectInterface;
use AoScrud\Utils\Traits\Data;
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

class RestoreConfig implements ModelInterface, DataInterface, KeysInterface, SelectInterface, ObjInterface
{

    use Model, Data, Keys, Select, Obj;
    use OnPrepare, OnPrepareEnd, OnPrepareError, OnExecute, OnExecuteEnd, OnExecuteError, OnSuccess, OnError;

}