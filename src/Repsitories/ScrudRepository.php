<?php

namespace AoScrud\Repositories;

use AoScrud\Repositories\Resources\Create;
use AoScrud\Repositories\Resources\Destroy;
use AoScrud\Repositories\Resources\Read;
use AoScrud\Repositories\Resources\Search;
use AoScrud\Repositories\Resources\Update;
use AoScrud\Util\Traits\Transactions;
use Illuminate\Database\Eloquent\Model;

abstract class ScrudRepository
{

    use Transactions, Search, Create, Read, Update, Destroy;

    //------------------------------------------------------------------------------------------------------------------

    /**
     * The model of repository.
     *
     * @var Model
     */
    private $model;

    /**
     * Return the model of repository.
     *
     * @return Model
     */
    public function model()
    {
        return $this->model;
    }

    /**
     *  Reset the model of repository.
     */
    public function modelReset()
    {
        $this->model = app()->make($this->modelClassName());
    }

    // ABSTRACT METHODS //----------------------------------------------------------------------------------------------

    /**
     * Return the model class name.
     *
     * @return string
     */
    abstract public function modelClassName();

    /**
     * Return the labels to fields.
     *
     * @return array
     */
    abstract public function modelLabels();

}