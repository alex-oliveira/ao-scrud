<?php

namespace AoScrud\Services\Configurators;

use AoScrud\Utils\Criteria\ColumnsCriteria;
use AoScrud\Utils\Criteria\RouteParamsCriteria;
use AoScrud\Utils\Criteria\WithCriteria;
use AoScrud\Services\Configs\Interfaces\IColumns;
use AoScrud\Services\Configs\Interfaces\ICriteria;
use AoScrud\Services\Configs\Interfaces\IKeys;
use AoScrud\Services\Configs\Interfaces\IObj;
use AoScrud\Services\Configs\Interfaces\IOtherColumns;
use AoScrud\Services\Configs\Interfaces\ISelect;
use AoScrud\Services\Configs\Interfaces\IWith;
use AoScrud\Services\Configs\Columns;
use AoScrud\Services\Configs\Criteria;
use AoScrud\Services\Configs\Keys;
use AoScrud\Services\Configs\Obj;
use AoScrud\Services\Configs\OtherColumns;
use AoScrud\Services\Configs\Select;
use AoScrud\Services\Configs\With;

class ReadConfigurator extends BaseConfigurator implements
    IKeys, IColumns, IOtherColumns, ISelect, IObj, ICriteria, IWith
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