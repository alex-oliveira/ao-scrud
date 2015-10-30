<?php

namespace AoScrud\Repositories\Traits;

use Illuminate\Database\Eloquent\Model;

trait ReadTrait
{

    /**
     * Read method.
     *
     * @param integer $id
     * @return Model
     */
    public function read($id)
    {
        $obj = $this->model()->find($id);

        if (empty($obj))
            abort(404);

        return $obj;
    }

}
