<?php

namespace AoScrud\Repositories\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait Create
{
    // MAIN METHOD //---------------------------------------------------------------------------------------------------

    /**
     * @param Collection|null $data
     * @return Model
     * @throws \Exception
     */
    public function create(Collection $data = null)
    {
        $this->modelReset();

        $this->createPrepare(is_null($data) ? $data = $this->createParams() : $data);

        $this->tBegin();
        try {
            $obj = $this->createSave($data);
        } catch (\Exception $e) {
            $this->tRollBack();
            throw $e;
        }
        $this->tCommit();

        return $obj;
    }

    // AUXILIARY METHODS //---------------------------------------------------------------------------------------------

    /**
     * Run all preparations before create.
     *
     * @param Collection $data
     */
    protected function createPrepare(Collection $data)
    {
        $this->createFilter($data);
        $this->createValidator($data);
    }

    /**
     * Return a merge of all params found in the request.
     *
     * @return Collection
     */
    protected function createParams()
    {
        return collect(array_merge(request()->all(), request()->route()->parameters()));
    }

    /**
     * Apply filters in the data received.
     *
     * @param Collection $data
     */
    protected function createFilter(Collection $data)
    {
        $this->model->fillable($this->createFillables());
    }

    /**
     * Apply validations in the data received.
     *
     * @param Collection $data
     */
    protected function createValidator(Collection $data)
    {
        // TODO: make your override
    }

    /**
     * Save data received.
     *
     * @param Collection $data
     * @return Model
     */
    protected function createSave(Collection $data)
    {
        return $this->model->create($data->all());
    }

    // ABSTRACT METHODS //----------------------------------------------------------------------------------------------

    /**
     * Return the allow fields to create.
     *
     * @return array
     */
    abstract public function createFillables();

}