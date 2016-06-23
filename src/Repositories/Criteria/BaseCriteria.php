<?php

namespace AoScrud\Repositories\Criteria;

abstract class BaseCriteria
{

    /**
     * @param \AoScrud\Repositories\BaseRepository
     * @return mixed
     */
    abstract public function apply($rep);

}