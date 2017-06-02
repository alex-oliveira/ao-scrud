<?php

namespace AoScrud\Actions;

trait Store
{

    public function store()
    {
        $data = $this->service->create(AoScrud()->params()->all());
        return response()->json(AoScrud()->controller()->toArray($data), 201);
    }

}