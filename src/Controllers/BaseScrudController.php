<?php

namespace AoScrud\Controllers;

use AoScrud\Services\ScrudService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;

abstract class BaseScrudController extends Controller
{

    /**
     * The object responsible by manager the resources.
     *
     * @var ScrudService
     */
    protected $service;

    public function toArray($data)
    {
        if (is_array($data))
            return $data;

        if (is_object($data) && method_exists($data, 'toArray'))
            return $data->toArray();

        if ($data instanceof Collection)
            return $data->all();

        return $data;
    }

}