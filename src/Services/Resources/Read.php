<?php

namespace AoScrud\Services\Resources;

use AoScrud\Utils\Criteria\ModelColumnsCriteria;
use AoScrud\Utils\Criteria\ModelWithCriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
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
    protected $readKeys = ['id'];

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

        $this->searchModel($data);
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
    protected function readQuery(Collection $data)
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
        $this->readFilter($data);
    }

    /**
     * Apply criteria.
     *
     * @param Collection $data
     */
    protected function readCriteria(Collection $data)
    {
        //$this->readCriteria[] = new ModelColumnsCriteria($model, $this->readColumns, $data);
        //$this->readCriteria[] = new ModelWithCriteria($model, $this->readWith, $data);
        //
        //if ($master) {
        //    foreach ($this->readCriteria as $criteria)
        //        $this->rep->pushCriteria($criteria);
        //} else {
        //    foreach ($this->readCriteria as $criteria) {
        //        if (isset($criteria->readonly) && $criteria->readonly == true)
        //            continue;
        //
        //        $this->rep->pushCriteria($criteria);
        //    }
        //}
    }

    /**
     * Apply key filter.
     *
     * @param Collection $data
     */
    protected function readFilter(Collection $data)
    {
        $data->forget(array_diff($data->keys()->all(), $this->readKeys));
    }

    /**
     * Run find command in the repository.
     *
     * @param Collection $data
     * @return Model
     */
    protected function readExecute(Collection $data)
    {
        $obj = $this->readModel->where($data->all())->first();

        if (is_null($obj))
            abort(404, 'Model not found');

        return $obj;
    }

}