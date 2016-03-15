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

        $query = $this->readQuery();
        $this->readPrepare($query, $data);
        $obj = $this->readExecute($query, $data);

        // DISPATCH EVENT

        return $obj;
    }

    //------------------------------------------------------------------------------------------------------------------
    // SECONDARY METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Return the model to read.
     *
     * @return Model|Relation
     */
    protected function readQuery()
    {
        return $this->model();
    }

    /**
     * Run all preparations before read.
     *
     * @param Model|Relation
     * @param Collection $data
     */
    protected function readPrepare($query, Collection $data)
    {
        $this->readCriteria($query, collect($data->all()));
        $this->readFilter($data);
    }

    /**
     * Apply criteria.
     *
     * @param Model|Relation
     * @param Collection $data
     */
    protected function readCriteria($query, Collection $data)
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
     * @param Model|Relation $query
     * @param Collection $data
     * @return Model
     */
    protected function readExecute($query, Collection $data)
    {
        $obj = $query->where($data->all())->first();

        if (is_null($obj))
            abort(404, 'Model not found');

        return $obj;
    }

}