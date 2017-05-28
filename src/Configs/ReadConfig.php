<?php

namespace AoScrud\Configs;

use AoScrud\Utils\Criteria\ColumnsCriteria;
use AoScrud\Utils\Criteria\RouteParamsCriteria;
use AoScrud\Utils\Criteria\WithCriteria;
use AoScrud\Configs\Interfaces\IColumns;
use AoScrud\Configs\Interfaces\ICriteria;
use AoScrud\Configs\Interfaces\IKeys;
use AoScrud\Configs\Interfaces\IObj;
use AoScrud\Configs\Interfaces\IOtherColumns;
use AoScrud\Configs\Interfaces\ISelect;
use AoScrud\Configs\Interfaces\IWith;
use AoScrud\Configs\Traits\Columns;
use AoScrud\Configs\Traits\Criteria;
use AoScrud\Configs\Traits\Keys;
use AoScrud\Configs\Traits\Obj;
use AoScrud\Configs\Traits\OtherColumns;
use AoScrud\Configs\Traits\Select;
use AoScrud\Configs\Traits\With;

class ReadConfig extends BaseConfig implements IKeys, IColumns, IOtherColumns, ISelect, IObj, ICriteria, IWith
{

    use Keys, Columns, OtherColumns, Select, Obj, Criteria, With;

    public function __construct()
    {
        $this->keys(['id']);

        $this->criteria()->put('params', RouteParamsCriteria::class);
        $this->criteria()->put('columns', ColumnsCriteria::class);
        $this->criteria()->put('with', WithCriteria::class);
    }

}