<?php

namespace AoScrud\Services\Resources;

use AoScrud\Utils\Criteria\ModelColumnsCriteria;
use AoScrud\Utils\Criteria\ModelWithCriteria;
use Illuminate\Database\Eloquent\Model;
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
     * @return Model|null
     * @throws \Exception
     */
    public function read(array $data, $master = false)
    {
        $this->readMaster = $master;

        $model = $this->model();
        $data = collect($data);

        $this->readPrepare($model, $data);

        try {
            $obj = $this->readExecute($model, $data);
        } catch (\Exception $e) {
            throw $e;
        }

        // DISPATCH EVENT

        return $obj;
    }

    //------------------------------------------------------------------------------------------------------------------
    // SECONDARY METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Run all preparations before read.
     *
     * @param Collection $data
     * @param Model $model
     */
    protected function readPrepare(Model $model, Collection $data)
    {
        $this->readCriteria($model, collect($data->all()));
        $this->readFilter($data);
    }

    /**
     * Apply criteria.
     *
     * @param Collection $data
     * @param Model $model
     */
    protected function readCriteria(Model $model, Collection $data)
    {
//        $this->readCriteria[] = new ModelColumnsCriteria($model, $this->readColumns, $data);
//        $this->readCriteria[] = new ModelWithCriteria($model, $this->readWith, $data);
//
//        if ($master) {
//            foreach ($this->readCriteria as $criteria)
//                $this->rep->pushCriteria($criteria);
//        } else {
//            foreach ($this->readCriteria as $criteria) {
//                if (isset($criteria->readonly) && $criteria->readonly == true)
//                    continue;
//
//                $this->rep->pushCriteria($criteria);
//            }
//        }
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
     * @param Model $model
     * @return Model
     */
    protected function readExecute(Model $model, Collection $data)
    {
        $obj = $model->where($data->all())->first();

        if (is_null($obj))
            abort(404, 'Model not found');

        return $obj;
    }

}