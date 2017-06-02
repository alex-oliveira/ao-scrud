<?php

namespace AoScrud\Configs;

use AoScrud\Configs\Interfaces\IData;
use AoScrud\Configs\Interfaces\IModel;
use AoScrud\Configs\Interfaces\IOnError;
use AoScrud\Configs\Interfaces\IOnExecute;
use AoScrud\Configs\Interfaces\IOnExecuteEnd;
use AoScrud\Configs\Interfaces\IOnExecuteError;
use AoScrud\Configs\Interfaces\IOnPrepare;
use AoScrud\Configs\Interfaces\IOnPrepareEnd;
use AoScrud\Configs\Interfaces\IOnPrepareError;
use AoScrud\Configs\Interfaces\IOnSuccess;
use AoScrud\Configs\Traits\Data;
use AoScrud\Configs\Traits\Model;
use AoScrud\Configs\Traits\OnError;
use AoScrud\Configs\Traits\OnExecute;
use AoScrud\Configs\Traits\OnExecuteEnd;
use AoScrud\Configs\Traits\OnExecuteError;
use AoScrud\Configs\Traits\OnPrepare;
use AoScrud\Configs\Traits\OnPrepareEnd;
use AoScrud\Configs\Traits\OnPrepareError;
use AoScrud\Configs\Traits\OnSuccess;

abstract class BaseConfig implements IModel, IData,
    IOnError, IOnExecute, IOnExecuteEnd, IOnExecuteError, IOnPrepare, IOnPrepareEnd, IOnPrepareError, IOnSuccess
{

    use Model, Data, OnPrepare, OnPrepareEnd, OnPrepareError, OnExecute, OnExecuteEnd, OnExecuteError, OnSuccess, OnError;

}