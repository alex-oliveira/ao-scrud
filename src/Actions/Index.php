<?php

namespace AoScrud\Actions;

trait Index
{

    public function index()
    {
        $data = $this->service->search(AoScrud()->params()->all());
        return response()->json(AoScrud()->controller()->toArray($data), 200);
    }

}