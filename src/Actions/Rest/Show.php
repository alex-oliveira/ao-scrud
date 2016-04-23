<?php

namespace AoScrud\Actions\Rest;

trait Show
{

    public function show()
    {
        $data = $this->service->tEnable()->read(array_merge(request()->all(), request()->route()->parameters()), true);
        return response()->json($this->toArray($data), 200);
    }

}