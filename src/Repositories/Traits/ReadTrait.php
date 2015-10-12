<?php

namespace AoScrud\Repositories\Traits;

trait ReadTrait
{

    /**
     * Read method.
     *
     * @param integer $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function read($id)
    {
        $obj = $this->model()->find($id);

        if (empty($obj))
            abort(404);

        return $obj;
    }

}
