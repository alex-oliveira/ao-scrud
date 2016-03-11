<?php

namespace AoScrud\Controllers\Rest\Actions;

trait Show
{

    public function show()
    {
        try {
            $data = $this->api->read(collect(array_merge(request()->all(), request()->route()->parameters())));
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json($this->toArray($data), 200);
    }

}