<?php

namespace AoScrud\Services\Configurators;

use AoScrud\Services\Configs\Interfaces\IKeys;
use AoScrud\Services\Configs\Interfaces\IObj;
use AoScrud\Services\Configs\Interfaces\ISelect;
use AoScrud\Services\Configs\Keys;
use AoScrud\Services\Configs\Obj;
use AoScrud\Services\Configs\Select;

class RestoreConfigurator extends BaseConfigurator implements
    IKeys, ISelect, IObj
{

    use Keys, Select, Obj;

    public function __construct()
    {
        $this->keys(['id']);
    }

}