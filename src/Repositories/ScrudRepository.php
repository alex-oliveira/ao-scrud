<?php

namespace AoScrud\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

abstract class ScrudRepository extends BaseRepository
{

    protected $fieldsFilters = [];
    protected $fieldsOrders = [];
    protected $fieldsWiths = [];

    public function getFieldsFilters()
    {
        return $this->fieldsFilters;
    }

    public function getFieldsOrders()
    {
        return $this->fieldsOrders;
    }

    public function getFieldsWiths()
    {
        return $this->fieldsWiths;
    }

}