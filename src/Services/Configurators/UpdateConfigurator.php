<?php

namespace AoScrud\Services\Configurators;

use AoScrud\Services\Configs\Interfaces\IColumns;
use AoScrud\Services\Configs\Interfaces\IKeys;
use AoScrud\Services\Configs\Interfaces\IObj;
use AoScrud\Services\Configs\Interfaces\IRules;
use AoScrud\Services\Configs\Interfaces\ISelect;
use AoScrud\Services\Configs\Columns;
use AoScrud\Services\Configs\Keys;
use AoScrud\Services\Configs\Obj;
use AoScrud\Services\Configs\Rules;
use AoScrud\Services\Configs\Select;

class UpdateConfigurator extends BaseConfigurator implements
    IKeys, IColumns, IRules, ISelect, IObj
{

    use Keys, Columns, Rules, Select, Obj;

    public function __construct()
    {
        $this->keys(['id']);
    }

}