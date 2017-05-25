<?php

namespace AoScrud\Configs;

use AoScrud\Interfaces\IData;
use AoScrud\Interfaces\IModel;
use AoScrud\Interfaces\IOnError;
use AoScrud\Interfaces\IOnExecute;
use AoScrud\Interfaces\IOnExecuteEnd;
use AoScrud\Interfaces\IOnExecuteError;
use AoScrud\Interfaces\IOnPrepare;
use AoScrud\Interfaces\IOnPrepareEnd;
use AoScrud\Interfaces\IOnPrepareError;
use AoScrud\Interfaces\IOnSuccess;
use AoScrud\Traits\Data;
use AoScrud\Traits\Model;
use AoScrud\Traits\OnError;
use AoScrud\Traits\OnExecute;
use AoScrud\Traits\OnExecuteEnd;
use AoScrud\Traits\OnExecuteError;
use AoScrud\Traits\OnPrepare;
use AoScrud\Traits\OnPrepareEnd;
use AoScrud\Traits\OnPrepareError;
use AoScrud\Traits\OnSuccess;

abstract class BaseConfig implements IModel, IData,
    IOnError, IOnExecute, IOnExecuteEnd, IOnExecuteError, IOnPrepare, IOnPrepareEnd, IOnPrepareError, IOnSuccess
{

    use Model, Data, OnPrepare, OnPrepareEnd, OnPrepareError, OnExecute, OnExecuteEnd, OnExecuteError, OnSuccess, OnError;

}