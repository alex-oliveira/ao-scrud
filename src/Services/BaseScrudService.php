<?php

namespace AoScrud\Services;

use AoScrud\Services\Resources\Entity;
use AoScrud\Utils\Traits\Transactions;

abstract class BaseService
{

    use Transactions, Entity;

}