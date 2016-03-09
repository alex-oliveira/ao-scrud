<?php

namespace AoScrud\Controllers\Rest\Actions;

trait Index
{

    public function index()
    {
        try {
            $data = $this->api->search();
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json($this->toArray($data), 200);
    }

}