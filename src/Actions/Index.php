<?php

namespace AoScrud\Actions;

trait Index
{

    public function index()
    {
        $data = $this->service->search(scrud()->params()->all());
        return response()->json($this->toArray($data), 200);
    }

    public function selectSearch($service)
    {
        $data = $service->search(scrud()->paramsSearch()->all());
        return response()->json($this->toArray($data), 200);
    }

}