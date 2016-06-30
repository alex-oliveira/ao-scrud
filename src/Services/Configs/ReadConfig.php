<?php

namespace AoScrud\Services\Configs;

use AoScrud\Utils\Criteria\ColumnsCriteria;
use AoScrud\Utils\Criteria\RouteParamsCriteria;
use AoScrud\Utils\Criteria\WithCriteria;
use AoScrud\Utils\Interfaces\Traits\ColumnsInterface;
use AoScrud\Utils\Interfaces\Traits\CriteriaInterface;
use AoScrud\Utils\Interfaces\Traits\DataInterface;
use AoScrud\Utils\Interfaces\Traits\KeysInterface;
use AoScrud\Utils\Interfaces\Traits\ModelInterface;
use AoScrud\Utils\Interfaces\Traits\ObjInterface;
use AoScrud\Utils\Interfaces\Traits\OtherColumnsInterface;
use AoScrud\Utils\Interfaces\Traits\SelectInterface;
use AoScrud\Utils\Interfaces\Traits\WithInterface;
use AoScrud\Utils\Traits\Columns;
use AoScrud\Utils\Traits\Criteria;
use AoScrud\Utils\Traits\Data;
use AoScrud\Utils\Traits\Keys;
use AoScrud\Utils\Traits\Model;
use AoScrud\Utils\Traits\Obj;
use AoScrud\Utils\Traits\OtherColumns;
use AoScrud\Utils\Traits\Select;
use AoScrud\Utils\Traits\With;

class ReadConfig implements ModelInterface, DataInterface, KeysInterface, ColumnsInterface, OtherColumnsInterface,
    SelectInterface, ObjInterface, CriteriaInterface, WithInterface
{

    use Model, Data, Keys, Columns, OtherColumns, Select, Obj, Criteria, With;

    public function __construct()
    {
        $this->criteria()->put('params',  RouteParamsCriteria::class);
        $this->criteria()->put('columns', ColumnsCriteria::class);
        $this->criteria()->put('with',    WithCriteria::class);
    }

}