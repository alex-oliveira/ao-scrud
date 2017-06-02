<?php

namespace AoScrud\Configs;

use AoScrud\Configs\Interfaces\IKeys;
use AoScrud\Configs\Interfaces\IObj;
use AoScrud\Configs\Interfaces\ISelect;
use AoScrud\Configs\Traits\Keys;
use AoScrud\Configs\Traits\Obj;
use AoScrud\Configs\Traits\Select;

class RestoreConfig extends BaseConfig implements IKeys, ISelect, IObj
{

    use Keys, Select, Obj;

    public function __construct()
    {
        $this->keys(['id']);
    }

}