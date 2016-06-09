<?php

namespace AoScrud\Services\Resources;

use AoScrud\Utils\Interceptors\BaseInterceptor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait Update
{

    /**
     * The validation rules to update or an interceptor class that return an array.
     *
     * @var array|BaseInterceptor
     */
    protected $updateRules = [];

    /**
     * The allowed fields to update.
     *
     * @var array
     */
    protected $updateFillable = [];

    //------------------------------------------------------------------------------------------------------------------
    // MAIN METHOD
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to update in the repository.
     *
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function update(array $data)
    {
        $data = collect($data);

        $obj = $this->updateSelect($data);
        $this->updatePrepare($data, $obj);

        $t = Transaction()->begin();
        try {
            $status = $this->updateRun($data, $obj);
        } catch (\Exception $e) {
            Transaction()->rollBack($t);
            throw $e;
        }
        Transaction()->commit($t);

        return $status;
    }

    //------------------------------------------------------------------------------------------------------------------
    // SECONDARY METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Return the object the should be updated.
     *
     * @param Collection $data
     * @return Model $obj
     */
    protected function updateSelect(Collection $data)
    {
        return $this->model()->find($data->get('id'));
    }

    /**
     * Rum the preparations to update.
     *
     * @param Collection $data
     * @param Model $obj
     */
    protected function updatePrepare(Collection $data, Model $obj)
    {
        $this->updateValidate($data, $obj);
        $this->updateFilter($data);
    }

    /**
     * Define the rule fields to update.
     *
     * @return array
     */
    protected function updateRules()
    {
        return $this->updateRules;
    }

    /**
     * Apply validation to update.
     *
     * @param Collection $data
     * @param Model $obj
     */
    protected function updateValidate(Collection $data, Model $obj)
    {
        Validate()->actor($this)->obj($obj)->data($data)->rules($this->updateRules())->run();
    }

    /**
     * Define the allow fields to update.
     *
     * @return array
     */
    protected function updateFillable()
    {
        return $this->updateFillable;
    }

    /**
     * Apply filter returning only the allowed fields to update.
     *
     * @param Collection $data
     */
    protected function updateFilter(Collection $data)
    {
        $data = $data->only($this->updateFillable());
    }

    /**
     * Run update command in the service.
     *
     * @param Collection $data
     * @param Model $obj
     * @return Model
     */
    protected function updateRun(Collection $data, Model $obj)
    {
        $obj->fill($data->all());
        return $obj->isDirty() ? $obj->save() : false;
    }

}