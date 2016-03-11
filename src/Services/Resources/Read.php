<?php

namespace AoScrud\Services\Resources;

use AoScrud\Utils\Criteria\ModelColumnsCriteria;
use AoScrud\Utils\Criteria\ModelWithCriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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
     * @param Collection $keys
     * @param bool $readonly
     * @return Model|null
     * @throws \Exception
     */
    public function read(Collection $keys, $readonly = true)
    {
        $this->readPrepare($keys, $readonly);

        try {
            $obj = $this->readExecute($keys);
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
     * @param Collection $keys
     * @param bool $readonly
     */
    protected function readPrepare(Collection $keys, $readonly = true)
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
     * @param Collection $keys
     * @return Model|null
     */
    protected function readExecute(Collection $keys)
    {
        $obj = $this->rep->findWhere($keys->all())->first();

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