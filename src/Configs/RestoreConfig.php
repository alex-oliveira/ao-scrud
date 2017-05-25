<?php

namespace AoScrud\Configs;

use AoScrud\Interfaces\IKeys;
use AoScrud\Interfaces\IObj;
use AoScrud\Interfaces\ISelect;
use AoScrud\Traits\Keys;
use AoScrud\Traits\Obj;
use AoScrud\Traits\Select;

class RestoreConfig extends BaseConfig implements IKeys, ISelect, IObj
{

    use Keys, Select, Obj;

}