<?php

namespace AoScrud\Repositories\Traits;

trait DestroyTrait
{

    /**
     * Main method of destroy.
     *
     * @param array $data
     * @return boolean
     * @throws \Exception
     */
    public function destroy($data)
    {
        $data = collect($data);

        $obj = $this->destroyFind($data);
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
     * @param \Illuminate\Support\Collection $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function destroyFind($data)
    {
        $obj = $this->model()->find($this->xId($data));

        if (empty($obj))
            abort(404);

        return $obj;
    }

    /**
     * Execute validation in the object for the destroy.
     *
     * @param \Illuminate\Database\Eloquent\Model $obj
     */
    protected function destroyValidator($obj)
    {
        // TODO: overwrite in repository.
    }

    /**
     * Execute model's delete method.
     *
     * @param \Illuminate\Database\Eloquent\Model $obj
     * @return bool|null
     * @throws \Exception
     */
    protected function destroyFinalize($obj)
    {
        return $obj->delete();
    }

}
