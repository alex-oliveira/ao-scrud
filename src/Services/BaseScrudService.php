<?php

namespace AoScrud\Services;

use AoScrud\Repositories\ScrudRepository;
use AoScrud\Utils\Traits\Transactions;
use Illuminate\Database\Eloquent\Model;

abstract class BaseScrudService
{

    use Transactions;

    // MODEL //---------------------------------------------------------------------------------------------------------

    /**
     * The model.
     *
     * @var Model
     */
    private $model;

    /**
     * The name model.
     *
     * @var Model
     */
    protected $modelName;

    /**
     * Return the model.
     *
     * @return Model
     */
    public function model()
    {
        return is_null($this->model) ? $this->model = app()->make($this->modelName) : $this->model;
    }

}