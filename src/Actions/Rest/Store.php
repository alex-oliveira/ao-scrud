<?php

namespace AoScrud\Actions\Rest;

trait Store
{

    public function store()
    {
        $data = $this->service->tEnable()->create(array_merge(request()->all(), request()->route()->parameters()));
        return response()->json($this->toArray($data), 201);
    }

}