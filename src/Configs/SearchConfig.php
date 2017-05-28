<?php

namespace AoScrud\Configs;

use AoScrud\Configs\Traits\MaxLimit;
use AoScrud\Utils\Criteria\ColumnsCriteria;
use AoScrud\Utils\Criteria\OrdersCriteria;
use AoScrud\Utils\Criteria\RouteParamsCriteria;
use AoScrud\Utils\Criteria\RulesCriteria;
use AoScrud\Utils\Criteria\WithCriteria;
use AoScrud\Configs\Interfaces\IColumns;
use AoScrud\Configs\Interfaces\ICriteria;
use AoScrud\Configs\Interfaces\IKeys;
use AoScrud\Configs\Interfaces\ILimit;
use AoScrud\Configs\Interfaces\IMaxLimit;
use AoScrud\Configs\Interfaces\IOrders;
use AoScrud\Configs\Interfaces\IOtherColumns;
use AoScrud\Configs\Interfaces\IRules;
use AoScrud\Configs\Interfaces\ITotal;
use AoScrud\Configs\Interfaces\IWith;
use AoScrud\Configs\Traits\Columns;
use AoScrud\Configs\Traits\Criteria;
use AoScrud\Configs\Traits\Keys;
use AoScrud\Configs\Traits\Limit;
use AoScrud\Configs\Traits\Orders;
use AoScrud\Configs\Traits\OtherColumns;
use AoScrud\Configs\Traits\Rules;
use AoScrud\Configs\Traits\Total;
use AoScrud\Configs\Traits\With;

class SearchConfig extends BaseConfig implements IKeys, IColumns, IOtherColumns, IRules, IOrders, ICriteria, IWith, ITotal, ILimit, IMaxLimit
{

    use Keys, Columns, OtherColumns, Rules, Orders, Criteria, With, Total, Limit, MaxLimit;

    public function __construct()
    {
        $this->keys(['id']);

        $this->criteria()->put('params', RouteParamsCriteria::class);
        $this->criteria()->put('rules', RulesCriteria::class);
        $this->criteria()->put('columns', ColumnsCriteria::class);
        $this->criteria()->put('with', WithCriteria::class);
        $this->criteria()->put('orders', OrdersCriteria::class);
    }

}