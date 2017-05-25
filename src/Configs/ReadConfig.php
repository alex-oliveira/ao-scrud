<?php

namespace AoScrud\Configs;

use AoScrud\Utils\Criteria\ColumnsCriteria;
use AoScrud\Utils\Criteria\RouteParamsCriteria;
use AoScrud\Utils\Criteria\WithCriteria;
use AoScrud\Interfaces\IColumns;
use AoScrud\Interfaces\ICriteria;
use AoScrud\Interfaces\IKeys;
use AoScrud\Interfaces\IObj;
use AoScrud\Interfaces\IOtherColumns;
use AoScrud\Interfaces\ISelect;
use AoScrud\Interfaces\IWith;
use AoScrud\Traits\Columns;
use AoScrud\Traits\Criteria;
use AoScrud\Traits\Keys;
use AoScrud\Traits\Obj;
use AoScrud\Traits\OtherColumns;
use AoScrud\Traits\Select;
use AoScrud\Traits\With;

class ReadConfig extends BaseConfig implements IKeys, IColumns, IOtherColumns, ISelect, IObj, ICriteria, IWith
{

    use Keys, Columns, OtherColumns, Select, Obj, Criteria, With;

    public function __construct()
    {
        $this->criteria()->put('params', RouteParamsCriteria::class);
        $this->criteria()->put('columns', ColumnsCriteria::class);
        $this->criteria()->put('with', WithCriteria::class);
    }

}