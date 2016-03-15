<?php

namespace AoScrud\Services;

use AoScrud\Services\Resources\Entity;
use AoScrud\Utils\Traits\Transactions;

abstract class ScrudService
{

    use Transactions, Entity;

}