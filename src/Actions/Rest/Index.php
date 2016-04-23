<?php

namespace AoScrud\Actions\Rest;

trait Index
{

    public function index()
    {
        $data = $this->service->tEnable()->search(array_merge(request()->all(), request()->route()->parameters()));
        return response()->json($this->toArray($data), 200);
    }

}