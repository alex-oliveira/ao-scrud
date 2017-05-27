<?php

namespace AoScrud\Configs;

use AoScrud\Utils\Criteria\ColumnsCriteria;
use AoScrud\Utils\Criteria\OrdersCriteria;
use AoScrud\Utils\Criteria\RouteParamsCriteria;
use AoScrud\Utils\Criteria\RulesCriteria;
use AoScrud\Utils\Criteria\WithCriteria;
use AoScrud\Interfaces\IColumns;
use AoScrud\Interfaces\ICriteria;
use AoScrud\Interfaces\IKeys;
use AoScrud\Interfaces\ILimit;
use AoScrud\Interfaces\IOrders;
use AoScrud\Interfaces\IOtherColumns;
use AoScrud\Interfaces\IRules;
use AoScrud\Interfaces\ITotal;
use AoScrud\Interfaces\IWith;
use AoScrud\Traits\Columns;
use AoScrud\Traits\Criteria;
use AoScrud\Traits\Keys;
use AoScrud\Traits\Limit;
use AoScrud\Traits\Orders;
use AoScrud\Traits\OtherColumns;
use AoScrud\Traits\Rules;
use AoScrud\Traits\Total;
use AoScrud\Traits\With;

class SearchConfig extends BaseConfig implements IKeys, IColumns, IOtherColumns, IRules, IOrders, ICriteria, IWith, ITotal, ILimit
{

    use Keys, Columns, OtherColumns, Rules, Orders, Criteria, With, Total, Limit;

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