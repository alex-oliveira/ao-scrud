<?php

namespace AoScrud\Actions;

trait Index
{

    public function index()
    {
        $data = $this->service->search(AoScrud()->params()->all());
        return response()->json($this->toArray($data), 200);
    }

    public function selectSearch($service)
    {
        $data = $service->search(AoScrud()->paramsSearch()->all());
        return response()->json($this->toArray($data), 200);
    }

}