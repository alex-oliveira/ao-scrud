<?php

namespace AoScrud\Controllers;

use AoScrud\Repositories\ScrudRepository;
use AoScrud\Services\ScrudService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;

abstract class BaseController extends Controller
{

    /**
     * The object responsible by manager the resources.
     *
     * @var ScrudRepository|ScrudService
     */
    protected $api;

    /**
     * @var string
     */
    protected $views = 'ao-scrud::controllers';

    /**
     * @var string
     */
    protected $langs = 'ao-scrud::controllers';

    public function toArray($data)
    {
        if (is_array($data))
            return $data;

        if ($data instanceof Model)
            return $data->toArray();

        if ($data instanceof Collection)
            return $data->all();

        return $data;
    }

}