<?php

namespace AoScrud\Services\Resources;

use AoScrud\Utils\Criteria\BaseCriteria;
use AoScrud\Utils\Criteria\ColumnsCriteria;
use AoScrud\Utils\Criteria\RouteParamsCriteria;
use AoScrud\Utils\Criteria\WithCriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait Read
{
    /**
     * The object to read.
     *
     * @var Model/Relation
     */
    protected $readModel;

    /**
     * Mark read como master resource in execution.
     *
     * @var bool
     */
    protected $readMaster = true;

    /**
     * The read's keys.
     *
     * @var array
     */
    protected $readRouteKeys = ['id'];

    /**
     * The read's criteria.
     *
     * @var array
     */
    protected $readCriteria = [];

    /**
     * The columns' names allowed.
     *
     * @var array
     */
    protected $readColumns = [];

    /**
     * The withs's names allowed.
     *
     * @var array
     */
    protected $readWith = [];

    //------------------------------------------------------------------------------------------------------------------
    // MAIN METHOD
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to read in the repository.
     *
     * @param array $data
     * @param bool $master
     * @return mixed
     */
    public function read(array $data, $master = false)
    {
        $data = collect($data);
        $this->readMaster = $master;

        $this->readModel($data);
        $this->readPrepare($data);
        $obj = $this->readExecute($data);

        // DISPATCH EVENT

        return $obj;
    }

    //------------------------------------------------------------------------------------------------------------------
    // SECONDARY METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Return the model to read.
     *
     * @param Collection $data
     */
    protected function readModel(Collection $data)
    {
        $this->readModel = $this->model();
    }

    /**
     * Run all preparations before read.
     *
     * @param Collection $data
     */
    protected function readPrepare(Collection $data)
    {
        $this->readCriteria(collect($data->all()));
        $this->readApplyCriteria(collect($data->all()));
    }

    /**
     * Apply criteria.
     *
     * @param Collection $data
     */
    protected function readCriteria(Collection $data)
    {
        $this->readCriteria[] = new RouteParamsCriteria($this->readRouteKeys);
        $this->readCriteria[] = new ColumnsCriteria($this->readColumns);
        $this->readCriteria[] = new WithCriteria($this->readWith);
    }

    /**
     * Apply criteria.
     *
     * @param Collection $data
     */
    protected function readApplyCriteria(Collection $data)
    {
        foreach ($this->readCriteria as $key => $criteria) {
            if (is_string($criteria) && is_subclass_of($criteria, BaseCriteria::class))
                $this->readCriteria[$key] = $criteria = app($criteria);

            if ($criteria instanceof BaseCriteria)
                $this->readModel = $criteria->apply($this->readModel, $data);
        }
    }

    /**
     * Run find command in the repository.
     *
     * @param Collection $data
     * @return Model
     */
    protected function readExecute(Collection $data)
    {
        $obj = $this->readModel->first();

        if (is_null($obj))
            abort(404, 'Model not found');

        return $obj;
    }

}