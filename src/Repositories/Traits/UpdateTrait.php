<?php

namespace AoScrud\Repositories\Traits;

use Ao\Exceptions\JsonException;
use Illuminate\Database\Eloquent\Model;
use Validator;

trait UpdateTrait
{

    /**
     * Main method of update.
     *
     * @param array $data
     * @param integer $id
     * @return boolean
     * @throws \Exception
     */
    public function update($id, array $data)
    {
        $this->updateTransformer($data);
        $this->updateValidator($id, $data);
        $obj = $this->updateFind($id);

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
     * @param array $data
     */
    protected function updateTransformer(array &$data)
    {
        // TODO: overwrite in repository.
    }

    /**
     * Execute validation in the data for the update.
     *
     * @param integer $id
     * @param array $data
     * @param \Closure $callback
     * @throws JsonException
     */
    protected function updateValidator($id, array &$data, \Closure $callback = null)
    {
        $validator = Validator::make($data, $this->updateRules($id));
        $validator->setAttributeNames($this->model()->labels());

        if (isset($callback))
            $validator->after($callback);

        if ($validator->fails())
            throw new JsonException(json_encode($validator->errors()->all()), 400);
    }

    /**
     * Find object for update.
     *
     * @param integer $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function updateFind($id)
    {
        $obj = $this->model()->find($id);

        if (empty($obj))
            abort(404);

        return $obj;
    }

    /**
     * Execute model's update method.
     *
     * @param Model $obj
     * @param array $data
     * @return bool
     */
    protected function updateSave(Model &$obj, array &$data)
    {
        $obj->fill($data);
        return $obj->isDirty() ? $obj->save() : false;
    }

}
