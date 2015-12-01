<?php

namespace AoScrud\Services\Resources\Update;

use AoScrud\Tools\Formatters\FormatterAbstract;
use AoScrud\Tools\Validators\ValidatorAbstract;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait Update
{

    /**
     * The formatter class to update in the repository.
     *
     * @var FormatterAbstract
     */
    protected $updateFormatter;

    /**
     * The validator class to update in repository.
     *
     * @var ValidatorAbstract
     */
    protected $updateValidator;

    //------------------------------------------------------------------------------------------------------------------
    // MASTERS //-------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to update in the repository.
     *
     * @param array $data
     * @param array $keys
     * @return bool
     * @throws Exception
     */
    public function update(array $data = null, array $keys = null)
    {
        $data = is_null($data) ? $this->updateData() : collect($data);

        $obj = $this->updateRead($keys);

        $this->updateFormatter($data);
        $this->updateValidator($data, $obj);

        $this->tBegin();
        try {
            $status = $this->updateSave($data, $obj);
        } catch (Exception $e) {
            $this->tRollBack();
            throw $e;
        }
        $this->tCommit();

        return $status;
    }

    /**
     * Return the data of request to update.
     *
     * @return Collection
     */
    protected function updateData()
    {
        return $this->data();
    }

    /**
     * Return the object the should be updated.
     *
     * @param array $keys
     * @return Model $obj
     */
    protected function updateRead(array $keys = null)
    {
        return $this->read($keys);
    }

    /**
     * Run formatter class in data of request.
     *
     * @param Collection $data
     * @return array
     */
    protected function updateFormatter($data)
    {
        if (isset($this->updateFormatter)) {
            if (is_string($this->updateFormatter) && is_subclass_of($this->updateFormatter, FormatterAbstract::class)) {
                $this->updateFormatter = app($this->updateFormatter);
            }
            is_object($this->updateFormatter) ? $this->updateFormatter->apply($data) : null;
        }
    }

    /**
     * Run validator class in data of request.
     *
     * @param Collection $data
     * @param Model $obj
     * @return array
     */
    protected function updateValidator($data, $obj)
    {
        if (isset($this->updateValidator)) {
            if (is_string($this->updateValidator) && is_subclass_of($this->updateValidator, ValidatorAbstract::class)) {
                $this->updateValidator = app($this->updateValidator);
            }
            is_object($this->updateValidator) ? $this->updateValidator->apply($data, $obj) : null;
        }
    }

    /**
     * Run update command in the repository.
     *
     * @param Collection $data
     * @param Model $obj
     * @return bool
     */
    protected function updateSave($data, $obj)
    {
        $obj->fill($data->all());
        return $obj->isDirty() ? $obj->save() : false;
    }

}