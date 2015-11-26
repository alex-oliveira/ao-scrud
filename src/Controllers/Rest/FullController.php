<?php

namespace AoScrud\Controllers\Rest;

class FullController extends BaseController
{

    public function index()
    {
        try {
            $result = $this->service->search();
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json($result->toArray(), 200);
    }


    public function store()
    {
        try {
            $obj = $this->service->create();
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json($obj->toArray(), 201);
    }

    public function show()
    {
        try {
            $obj = $this->service->read();
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json($obj->toArray(), 200);
    }

    public function update()
    {
        try {
            $status = $this->service->update();
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([], ($status ? 204 : 304));
    }

    public function destroy()
    {
        try {
            $status = $this->service->destroy();
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([], ($status ? 204 : 304));
    }

}