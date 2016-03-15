<?php

namespace AoScrud\Controllers\Rest\Actions;

trait Index
{

    public function index()
    {
        $data = $this->api->search(array_merge(request()->all(), request()->route()->parameters()));
        return response()->json($this->toArray($data), 200);
    }

}