<?php

namespace AoScrud\Controllers\Actions;

trait Index
{

    public function index()
    {
        $data = $this->service->search(AoScrud()->params()->all());
        return response()->json(AoScrud()->toArray($data), 200);
    }

}