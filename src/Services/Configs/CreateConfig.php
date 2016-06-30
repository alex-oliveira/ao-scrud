<?php

namespace AoScrud\Services\Configs;

use AoScrud\Utils\Interfaces\Traits\ColumnsInterface;
use AoScrud\Utils\Interfaces\Traits\DataInterface;
use AoScrud\Utils\Interfaces\Traits\ModelInterface;
use AoScrud\Utils\Interfaces\Traits\RulesInterface;
use AoScrud\Utils\Traits\Columns;
use AoScrud\Utils\Traits\Data;
use AoScrud\Utils\Traits\Model;
use AoScrud\Utils\Traits\OnError;
use AoScrud\Utils\Traits\OnExecute;
use AoScrud\Utils\Traits\OnExecuteEnd;
use AoScrud\Utils\Traits\OnExecuteError;
use AoScrud\Utils\Traits\OnPrepare;
use AoScrud\Utils\Traits\OnPrepareEnd;
use AoScrud\Utils\Traits\OnPrepareError;
use AoScrud\Utils\Traits\OnSuccess;
use AoScrud\Utils\Traits\Rules;

class CreateConfig implements ModelInterface, DataInterface, ColumnsInterface, RulesInterface
{

    use Model, Data, Columns, Rules;
    use OnPrepare, OnPrepareEnd, OnPrepareError, OnExecute, OnExecuteEnd, OnExecuteError, OnSuccess, OnError;

}