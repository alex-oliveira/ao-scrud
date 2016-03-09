<?php

namespace AoScrud\Controllers\Rest\Actions;

trait Show
{

    public function show()
    {
        try {
            $data = $this->api->read();
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json($this->toArray($data), 200);
    }

}