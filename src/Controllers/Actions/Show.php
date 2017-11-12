<?php

namespace AoScrud\Controllers\Actions;

trait Show
{

    public function show()
    {
        $data = $this->service->read(AoScrud()->params()->all());
        return response()->json(AoScrud()->toArray($data), 200);
    }

}