<?php

namespace AoScrud\Repositories\Traits;

use Validator;

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
     * Return an array with the validation rules for the registration.
     *
     * @return array
     */
    abstract public function createRules();

    /**
     * Prepare data for the registration.
     *
     * @param array $data
     */
    protected function createTransformer(array &$data)
    {
        // TODO: overwrite in repository.
    }

    /**
     * Execute validation in the data for the registration.
     *
     * @param array $data
     * @param \Closure $callback
     * @throws \Exception
     */
    protected function createValidator(array &$data, \Closure $callback = null)
    {
        $validator = Validator::make($data, $this->createRules());

        if (isset($callback))
            $validator->after($callback);

        if ($validator->fails())
            abort(400, $validator->errors()->first());
    }

    /**
     * Execute model's create method.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function createSave(array &$data)
    {
        return $this->model()->create($data);
    }

}
