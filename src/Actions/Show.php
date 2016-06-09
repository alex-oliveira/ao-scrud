<?php

namespace AoScrud\Actions;

trait Show
{

    public function show()
    {
        $data = $this->service->read(array_merge(request()->all(), request()->route()->parameters()), true);
        return response()->json($this->toArray($data), 200);
    }

}