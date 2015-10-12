<?php

namespace AoScrud\Repositories\Traits;

trait DestroyTrait
{

    /**
     * Main method of destroy.
     *
     * @param integer $id
     * @return boolean
     * @throws \Exception
     */
    public function destroy($id)
    {
        $obj = $this->destroyFind($id);
        $this->destroyValidator($obj);

        $this->tBegin();
        try {
            $result = $this->destroyFinalize($obj);
        } catch (\Exception $e) {
            $this->tRollBack();
            abort($e->getCode(), $e->getMessage());
        }
        $this->tCommit();

        return $result;
    }

    /**
     * Find object for destroy.
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function destroyFind($id)
    {
        $obj = $this->model()->find($id);

        if (empty($obj))
            abort(404);

        return $obj;
    }

    /**
     * Execute validation in the object for the destroy.
     *
     * @param \Illuminate\Database\Eloquent\Model|Model $obj
     */
    protected function destroyValidator(Model &$obj)
    {
        // TODO: overwrite in repository.
    }

    /**
     * Execute model's delete method.
     *
     * @param \Illuminate\Database\Eloquent\Model|Model $obj
     * @return bool|null
     * @throws \Exception
     */
    protected function destroyFinalize(Model &$obj)
    {
        return $obj->delete();
    }

}
