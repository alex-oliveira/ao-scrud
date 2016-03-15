<?php

namespace AoScrud\Controllers\Rest\Actions;

trait Show
{

    public function show()
    {
        $data = $this->api->read(array_merge(request()->all(), request()->route()->parameters()), true);
        return response()->json($this->toArray($data), 200);
    }

}