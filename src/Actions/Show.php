<?php

namespace AoScrud\Actions;

trait Show
{

    public function show()
    {
        $data = $this->service->read(AoScrud()->params()->all());
        return response()->json($this->toArray($data), 200);
    }

}