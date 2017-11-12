<?php

namespace AoScrud\Services\Configurators;

use AoScrud\Services\Configs\MaxLimit;
use AoScrud\Utils\Criteria\ColumnsCriteria;
use AoScrud\Utils\Criteria\OrdersCriteria;
use AoScrud\Utils\Criteria\RouteParamsCriteria;
use AoScrud\Utils\Criteria\RulesCriteria;
use AoScrud\Utils\Criteria\WithCriteria;
use AoScrud\Services\Configs\Interfaces\IColumns;
use AoScrud\Services\Configs\Interfaces\ICriteria;
use AoScrud\Services\Configs\Interfaces\IKeys;
use AoScrud\Services\Configs\Interfaces\ILimit;
use AoScrud\Services\Configs\Interfaces\IMaxLimit;
use AoScrud\Services\Configs\Interfaces\IOrders;
use AoScrud\Services\Configs\Interfaces\IOtherColumns;
use AoScrud\Services\Configs\Interfaces\IRules;
use AoScrud\Services\Configs\Interfaces\ITotal;
use AoScrud\Services\Configs\Interfaces\IWith;
use AoScrud\Services\Configs\Columns;
use AoScrud\Services\Configs\Criteria;
use AoScrud\Services\Configs\Keys;
use AoScrud\Services\Configs\Limit;
use AoScrud\Services\Configs\Orders;
use AoScrud\Services\Configs\OtherColumns;
use AoScrud\Services\Configs\Rules;
use AoScrud\Services\Configs\Total;
use AoScrud\Services\Configs\With;

class SearchConfigurator extends BaseConfigurator implements
    IKeys, IColumns, IOtherColumns, IRules, IOrders, ICriteria, IWith, ITotal, ILimit, IMaxLimit
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