<?php

namespace AoScrud\Configs;

use AoScrud\Configs\Interfaces\IColumns;
use AoScrud\Configs\Interfaces\IRules;
use AoScrud\Configs\Traits\Columns;
use AoScrud\Configs\Traits\Rules;

class CreateConfig extends BaseConfig implements IColumns, IRules
{

    use Columns, Rules;

}