<?php

namespace AoScrud\Services;

use AoScrud\Repositories\ScrudRepository;
use AoScrud\Utils\Traits\Transactions;
use Illuminate\Database\Eloquent\Model;

abstract class BaseScrudService
{

    use Transactions;

    // CONSTRUCT //-----------------------------------------------------------------------------------------------------

    public function __construct()
    {
        $this->modelReset();
    }

    // MODEL //---------------------------------------------------------------------------------------------------------

    /**
     * Attribute that store model.
     *
     * @var Model
     */
    protected $model;

    /**
     * Return the model.
     *
     * @return Model
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * Return the model name.
     *
     * @return string
     */
    abstract public function modelName();

    /**
     * Reset the model.
     */
    public function modelReset()
    {
        $this->model = app()->make($this->modelName());
    }

}