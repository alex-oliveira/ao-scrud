<?php

namespace AoScrud\Configs;

use AoScrud\Interfaces\IColumns;
use AoScrud\Interfaces\IKeys;
use AoScrud\Interfaces\IObj;
use AoScrud\Interfaces\IRules;
use AoScrud\Interfaces\ISelect;
use AoScrud\Traits\Columns;
use AoScrud\Traits\Keys;
use AoScrud\Traits\Obj;
use AoScrud\Traits\Rules;
use AoScrud\Traits\Select;

class UpdateConfig extends BaseConfig implements IKeys, IColumns, IRules, ISelect, IObj
{

    use Keys, Columns, Rules, Select, Obj;

}