<?php

namespace AoScrud\Repositories;

use AoScrud\Repositories\Traits\ReadTrait;
use AoScrud\Repositories\Traits\SearchTrait;

abstract class SearchRepository extends BaseRepository
{

    /**
     * Traits of the repository.
     */
    use SearchTrait, ReadTrait;

}
