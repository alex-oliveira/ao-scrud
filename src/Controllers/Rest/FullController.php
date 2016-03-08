<?php

namespace AoScrud\Controllers\Rest;

use Exception;

class FullController extends BaseController
{

    public function index()
    {
        try {
            $data = $this->service->search();
        } catch (Exception $e) {
            throw $e;
        }

        return response()->json(is_array($data) ? $data : $data->toArray(), 200);
    }

    public function show()
    {
        try {
            $data = $this->service->read();
        } catch (Exception $e) {
            throw $e;
        }

        return response()->json(is_array($data) ? $data : $data->toArray(), 200);
    }

    public function store()
    {
        try {
            $data = $this->service->create();
        } catch (Exception $e) {
            throw $e;
        }

        return response()->json(is_array($data) ? $data : $data->toArray(), 201);
    }

    public function update()
    {
        try {
            $changed = $this->service->update();
        } catch (Exception $e) {
            throw $e;
        }

        return response()->json([], ($changed ? 204 : 200));
    }

    public function destroy()
    {
        try {
            $this->service->destroy();
        } catch (Exception $e) {
            throw $e;
        }

        return response()->json([], 204);
    }

}