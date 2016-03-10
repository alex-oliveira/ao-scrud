<?php

namespace AoScrud\Services\Resources;

use AoScrud\Utils\Criteria\ModelColumnsCriteria;
use AoScrud\Utils\Criteria\ModelWithCriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use PhpSpec\Exception\Exception;

trait Read
{

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
     * @throws Exception
     */
    public function read(Collection $data = null, $readonly = true)
    {
        $this->readPrepare(is_null($data) ? $data = $this->readParams() : $data, $readonly);

        try {
            $obj = $this->readExecute($data);
        } catch (Exception $e) {
            throw $e;
        }

        if (is_null($obj)) {
            throw new ModelNotFoundException();
        }

        return $obj;
    }

    //------------------------------------------------------------------------------------------------------------------
    // SECONDARY METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Return the data of request to read.
     *
     * @return Collection
     */
    protected function readParams()
    {
        return collect(request()->route()->parameters());
    }

    /**
     * Run all preparations before read.
     *
     * @param Collection $data
     * @param bool $readonly
     */
    protected function readPrepare(Collection $data, $readonly = true)
    {
        $this->readCriteria[] = new ModelColumnsCriteria($this->getReadColumns());
        $this->readCriteria[] = new ModelWithCriteria($this->getReadWith());

        if ($readonly) {
            foreach ($this->readCriteria as $criteria)
                $this->rep->pushCriteria($criteria);
        } else {
            foreach ($this->readCriteria as $criteria) {
                if (isset($criteria->readonly) && $criteria->readonly == true) {
                    continue;
                }
                $this->rep->pushCriteria($criteria);
            }
        }
    }

    /**
     * Run find command in the repository.
     *
     * @param Collection $data
     * @return Model|null
     */
    protected function readExecute(Collection $data)
    {
        return $this->rep->findWhere($data->all())->first();
    }

    //------------------------------------------------------------------------------------------------------------------
    // SECONDARY METHODS
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