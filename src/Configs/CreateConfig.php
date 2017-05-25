<?php

namespace AoScrud\Configs;

use AoScrud\Interfaces\IColumns;
use AoScrud\Interfaces\IRules;
use AoScrud\Traits\Columns;
use AoScrud\Traits\Rules;

class CreateConfig extends BaseConfig implements IColumns, IRules
{

    use Columns, Rules;

}