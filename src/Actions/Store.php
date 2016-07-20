<?php

namespace AoScrud\Actions;

trait Store
{

    public function store()
    {
        $data = $this->service->create(scrud()->params()->all());
        return response()->json($this->toArray($data), 201);
    }

}