<?php

namespace AoScrud\Repositories\Traits;

use AoScrud\Exceptions\JsonException;

trait UpdateTrait
{

    /**
     * Main method of update.
     *
     * @param array $data
     * @return boolean
     * @throws \Exception
     */
    public function update(array $data)
    {
        $data = collect($data);

        $this->updateTransformer($data);
        $this->updateValidator($data);
        $obj = $this->updateFind($data);

        $this->tBegin();
        try {
            $result = $this->updateSave($obj, $data);
        } catch (\Exception $e) {
            $this->tRollBack();
            abort($e->getCode(), $e->getMessage());
        }
        $this->tCommit();

        return $result;
    }

    /**
     * Prepare data for the update.
     *
     * @param \Illuminate\Support\Collection $data
     */
    protected function updateTransformer($data)
    {
        // TODO: overwrite in repository.
    }

    /**
     * Execute validation in the data for the update.
     *
     * @param \Illuminate\Support\Collection $data
     * @param \Closure $callback
     * @throws JsonException
     */
    protected function updateValidator($data, \Closure $callback = null)
    {
        $rules = $this->updateRules($data);
        $validator = app('validator')->make($data->all(), $rules);
        ($labels = $this->labels()) ? $validator->setAttributeNames($labels) : null;

        if (isset($callback))
            $validator->after($callback);

        if ($validator->fails())
            throw new JsonException(json_encode($validator->errors()->all()), 400);
    }

    /**
     * Return an array with the validation rules for the update.
     *
     * @param \Illuminate\Support\Collection $data
     * @return array
     */
    protected function updateRules($data)
    {
        return []; // TODO: overwrite in repository.
    }

    /**
     * Find object for update.
     *
     * @param \Illuminate\Support\Collection $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function updateFind($data)
    {
        $obj = $this->model->find($this->xId($data));

        if (empty($obj))
            abort(404);

        return $obj;
    }

    /**
     * Execute model's update method.
     *
     * @param \Illuminate\Database\Eloquent\Model $obj
     * @param \Illuminate\Support\Collection $data
     * @return bool
     */
    protected function updateSave($obj, $data)
    {
        $obj->fill($data->all());
        return $obj->isDirty() ? $obj->save() : false;
    }

}
