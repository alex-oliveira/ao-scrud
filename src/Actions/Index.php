<?php

namespace AoScrud\Actions;

trait Index
{

    public function index()
    {
        $data = $this->service->search(array_merge(request()->all(), request()->route()->parameters()));
        return response()->json($this->toArray($data), 200);
    }

}