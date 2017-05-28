<?php

namespace AoScrud\Configs;

use AoScrud\Configs\Interfaces\IColumns;
use AoScrud\Configs\Interfaces\IKeys;
use AoScrud\Configs\Interfaces\IObj;
use AoScrud\Configs\Interfaces\IRules;
use AoScrud\Configs\Interfaces\ISelect;
use AoScrud\Configs\Traits\Columns;
use AoScrud\Configs\Traits\Keys;
use AoScrud\Configs\Traits\Obj;
use AoScrud\Configs\Traits\Rules;
use AoScrud\Configs\Traits\Select;

class UpdateConfig extends BaseConfig implements IKeys, IColumns, IRules, ISelect, IObj
{

    use Keys, Columns, Rules, Select, Obj;

    public function __construct()
    {
        $this->keys(['id']);
    }

}