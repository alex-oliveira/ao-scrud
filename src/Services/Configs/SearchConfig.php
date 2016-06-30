<?php

namespace AoScrud\Services\Configs;

use AoScrud\Utils\Criteria\ColumnsCriteria;
use AoScrud\Utils\Criteria\OrdersCriteria;
use AoScrud\Utils\Criteria\RouteParamsCriteria;
use AoScrud\Utils\Criteria\RulesCriteria;
use AoScrud\Utils\Criteria\WithCriteria;
use AoScrud\Utils\Interfaces\Traits\ColumnsInterface;
use AoScrud\Utils\Interfaces\Traits\CriteriaInterface;
use AoScrud\Utils\Interfaces\Traits\DataInterface;
use AoScrud\Utils\Interfaces\Traits\KeysInterface;
use AoScrud\Utils\Interfaces\Traits\LimitInterface;
use AoScrud\Utils\Interfaces\Traits\ModelInterface;
use AoScrud\Utils\Interfaces\Traits\OrdersInterface;
use AoScrud\Utils\Interfaces\Traits\OtherColumnsInterface;
use AoScrud\Utils\Interfaces\Traits\RulesInterface;
use AoScrud\Utils\Interfaces\Traits\TotalInterface;
use AoScrud\Utils\Interfaces\Traits\WithInterface;
use AoScrud\Utils\Traits\Columns;
use AoScrud\Utils\Traits\Criteria;
use AoScrud\Utils\Traits\Data;
use AoScrud\Utils\Traits\Keys;
use AoScrud\Utils\Traits\Limit;
use AoScrud\Utils\Traits\Model;
use AoScrud\Utils\Traits\OnError;
use AoScrud\Utils\Traits\OnExecute;
use AoScrud\Utils\Traits\OnExecuteEnd;
use AoScrud\Utils\Traits\OnExecuteError;
use AoScrud\Utils\Traits\OnPrepare;
use AoScrud\Utils\Traits\OnPrepareEnd;
use AoScrud\Utils\Traits\OnPrepareError;
use AoScrud\Utils\Traits\OnSuccess;
use AoScrud\Utils\Traits\Orders;
use AoScrud\Utils\Traits\OtherColumns;
use AoScrud\Utils\Traits\Rules;
use AoScrud\Utils\Traits\Total;
use AoScrud\Utils\Traits\With;

class SearchConfig implements ModelInterface, DataInterface, KeysInterface, ColumnsInterface, OtherColumnsInterface,
    RulesInterface, OrdersInterface, CriteriaInterface, WithInterface, TotalInterface, LimitInterface
{

    use Model, Data, Keys, Columns, OtherColumns, Rules, Orders, Criteria, With, Total, Limit;
    use OnPrepare, OnPrepareEnd, OnPrepareError, OnExecute, OnExecuteEnd, OnExecuteError, OnSuccess, OnError;

    public function __construct()
    {
        $this->criteria()->put('params', RouteParamsCriteria::class);
        $this->criteria()->put('rules', RulesCriteria::class);
        $this->criteria()->put('columns', ColumnsCriteria::class);
        $this->criteria()->put('with', WithCriteria::class);
        $this->criteria()->put('orders', OrdersCriteria::class);
    }

}