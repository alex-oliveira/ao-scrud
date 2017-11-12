<?php

namespace AoScrud\Services\Configurators;

use AoScrud\Services\Configs\Interfaces\IColumns;
use AoScrud\Services\Configs\Interfaces\IRules;
use AoScrud\Services\Configs\Columns;
use AoScrud\Services\Configs\Rules;

class CreateConfigurator extends BaseConfigurator implements
    IColumns, IRules
{

    use Columns, Rules;

}