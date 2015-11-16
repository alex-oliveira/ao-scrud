<?php

namespace AoScrud\Repositories\Traits;

trait ReadTrait
{

    /**
     * Read method.
     *
     * @@param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function read(array $data)
    {
        $obj = $this->model->find($this->xId($data));

        if (empty($obj))
            abort(404);

        return $obj;
    }

}
