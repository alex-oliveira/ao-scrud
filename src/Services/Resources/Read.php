<?php

namespace AoScrud\Services\Resources;

use AoScrud\Utils\Criteria\ModelColumnsCriteria;
use AoScrud\Utils\Criteria\ModelWithCriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait Read
{

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
     * @param Collection $data
     * @param bool $readonly
     * @return Model|null
     * @throws \Exception
     */
    public function read(Collection $data, $readonly = true)
    {
        $this->readPrepare($data, $readonly);

        try {
            $obj = $this->readExecute($data);
        } catch (\Exception $e) {
            throw $e;
        }

        return $obj;
    }

    //------------------------------------------------------------------------------------------------------------------
    // SECONDARY METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Run all preparations before read.
     *
     * @param Collection $data
     * @param bool $readonly
     */
    protected function readPrepare(Collection $data, $readonly = true)
    {
        $this->readCriteria(collect($data->all()), $readonly);
        $this->readFilter($data, $readonly);
    }

    /**
     * Apply criteria.
     *
     * @param Collection $data
     * @param bool $readonly
     */
    protected function readCriteria(Collection $data, $readonly = true)
    {
        $this->readCriteria[] = new ModelColumnsCriteria($this->getReadColumns(), $data);
        $this->readCriteria[] = new ModelWithCriteria($this->getReadWith(), $data);

        if ($readonly) {
            foreach ($this->readCriteria as $criteria)
                $this->rep->pushCriteria($criteria);
        } else {
            foreach ($this->readCriteria as $criteria) {
                if (isset($criteria->readonly) && $criteria->readonly == true)
                    continue;

                $this->rep->pushCriteria($criteria);
            }
        }
    }

    /**
     * Apply key filter.
     *
     * @param Collection $data
     * @param bool $readonly
     */
    protected function readFilter(Collection $data, $readonly = true)
    {
        $data->forget(array_diff($data->keys()->all(), $this->readKeys));
    }

    /**
     * Run find command in the repository.
     *
     * @param Collection $data
     * @return Model|null
     */
    protected function readExecute(Collection $data)
    {
        $obj = $this->rep->findWhere($data->all())->first();

        if (is_null($obj))
            abort(404, 'Model not found');

        return $obj;
    }

    //------------------------------------------------------------------------------------------------------------------
    // AUXILIARY METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Return the columns' names allowed.
     *
     * @return array
     */
    public function getReadColumns()
    {
        return $this->readColumns;
    }

    /**
     * Return the withs' names allowed.
     *
     * @return array
     */
    public function getReadWith()
    {
        return $this->readWith;
    }

}