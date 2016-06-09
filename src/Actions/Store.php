<?php

namespace AoScrud\Actions;

trait Store
{

    public function store()
    {
        $data = $this->service->create(array_merge(request()->all(), request()->route()->parameters()));
        return response()->json($this->toArray($data), 201);
    }

}