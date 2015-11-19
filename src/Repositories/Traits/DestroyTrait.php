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
        $obj = $this->destroyRead($data);
        $this->destroyValidator($obj);

        $this->tBegin();
        try {
            $result = $this->destroyFinalize($obj);
        } catch (\Exception $e) {
            $this->tRollBack();
            throw $e;
        }
        $this->tCommit();

        return $result;
    }

    /**
     * Find object for destroy.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function destroyRead($data)
    {
        return $this->read($data);
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
