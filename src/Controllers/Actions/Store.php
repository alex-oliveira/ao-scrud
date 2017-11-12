<?php

namespace AoScrud\Controllers\Actions;

trait Store
{

    public function store()
    {
        $data = $this->service->create(AoScrud()->params()->all());
        return response()->json(AoScrud()->toArray($data), 201);
    }

}