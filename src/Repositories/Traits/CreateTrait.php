<?php

namespace AoScrud\Repositories\Traits;

use AoScrud\Exceptions\JsonException;

trait CreateTrait
{

    /**
     * Main method for the registration.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function create(array $data)
    {
        $data = collect($data);

        $this->createTransformer($data);
        $this->createValidator($data);

        $this->tBegin();
        try {
            $obj = $this->createSave($data);
        } catch (\Exception $e) {
            $this->tRollBack();
            abort($e->getCode(), $e->getMessage());
        }
        $this->tCommit();

        return $obj;
    }

    /**
     * Prepare data for the registration.
     *
     * @param \Illuminate\Support\Collection $data
     * @return array
     */
    protected function createTransformer($data)
    {
        // TODO: overwrite in your repository.
    }

    /**
     * Execute validation in the data for the registration.
     *
     * @param \Illuminate\Support\Collection $data
     * @param \Closure $callback
     * @throws JsonException
     */
    protected function createValidator($data, \Closure $callback = null)
    {
        $validator = app('validator')->make($data->all(), $this->createRules($data));
        $validator->setAttributeNames($this->labels());

        if (isset($callback))
            $validator->after($callback);

        if ($validator->fails())
            throw new JsonException(json_encode($validator->errors()->all()), 400);
    }

    /**
     * Return an array with the validation rules for the registration.
     *
     * @param \Illuminate\Support\Collection $data
     * @return array
     */
    protected function createRules($data)
    {
        return []; // TODO: overwrite in repository.
    }

    /**
     * Execute model's create method.
     *
     * @param \Illuminate\Support\Collection $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function createSave($data)
    {
        return $this->model->create($data->all());
    }

}
