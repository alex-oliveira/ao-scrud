<?php

namespace AoScrud\Actions;

trait Show
{

    public function show()
    {
        $data = $this->service->read(AoScrud()->params()->all());
        return response()->json(AoScrud()->controller()->toArray($data), 200);
    }

}