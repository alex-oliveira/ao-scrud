<?php

namespace AoScrud\Services\Configurators;

use AoScrud\Services\Configs\Interfaces\IData;
use AoScrud\Services\Configs\Interfaces\IModel;
use AoScrud\Services\Configs\Interfaces\IOnError;
use AoScrud\Services\Configs\Interfaces\IOnExecute;
use AoScrud\Services\Configs\Interfaces\IOnExecuteEnd;
use AoScrud\Services\Configs\Interfaces\IOnExecuteError;
use AoScrud\Services\Configs\Interfaces\IOnPrepare;
use AoScrud\Services\Configs\Interfaces\IOnPrepareEnd;
use AoScrud\Services\Configs\Interfaces\IOnPrepareError;
use AoScrud\Services\Configs\Interfaces\IOnSuccess;
use AoScrud\Services\Configs\Data;
use AoScrud\Services\Configs\Model;
use AoScrud\Services\Configs\OnError;
use AoScrud\Services\Configs\OnExecute;
use AoScrud\Services\Configs\OnExecuteEnd;
use AoScrud\Services\Configs\OnExecuteError;
use AoScrud\Services\Configs\OnPrepare;
use AoScrud\Services\Configs\OnPrepareEnd;
use AoScrud\Services\Configs\OnPrepareError;
use AoScrud\Services\Configs\OnSuccess;

abstract class BaseConfigurator implements
    IModel, IData, IOnError, IOnExecute, IOnExecuteEnd, IOnExecuteError, IOnPrepare, IOnPrepareEnd, IOnPrepareError, IOnSuccess
{

    use Model, Data, OnPrepare, OnPrepareEnd, OnPrepareError, OnExecute, OnExecuteEnd, OnExecuteError, OnSuccess, OnError;

}