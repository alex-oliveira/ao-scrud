<?php

namespace AoScrud\Repositories;

use AoScrud\Repositories\Traits\CreateTrait;
use AoScrud\Repositories\Traits\DestroyTrait;
use AoScrud\Repositories\Traits\TransactionTrait;
use AoScrud\Repositories\Traits\UpdateTrait;

abstract class FullRepository extends SearchRepository
{

    /**
     * Traits of the repository.
     */
    use CreateTrait, UpdateTrait, DestroyTrait, TransactionTrait;

}
