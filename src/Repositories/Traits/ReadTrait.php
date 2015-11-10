<?php

namespace AoScrud\Repositories\Traits;

trait ReadTrait
{

    /**
     * Read method.
     *
     * @@param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function read($request)
    {
        $obj = $this->model->find($request->route()->parameter('id'));

        if (empty($obj))
            abort(404);

        return $obj;
    }

}
