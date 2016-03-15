<?php

namespace AoScrud\Controllers\Rest\Actions;

trait Store
{

    public function store()
    {
        $data = $this->api->create(array_merge(request()->all(), request()->route()->parameters()));
        return response()->json($this->toArray($data), 201);
    }

}