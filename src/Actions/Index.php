<?php

namespace AoScrud\Actions;

trait Index
{

    public function index()
    {
        $data = $this->service->search(scrud()->params()->all());
        return response()->json($this->toArray($data), 200);
    }

}