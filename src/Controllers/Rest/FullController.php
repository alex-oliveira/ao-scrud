<?php

namespace AoScrud\Controllers\Rest;

use Exception;

class FullController extends BaseController
{

    public function search()
    {
        try {
            $result = $this->service->search();
        } catch (Exception $e) {
            throw $e;
        }

        return response()->json($result->toArray(), 200);
    }

    public function show()
    {
        try {
            $obj = $this->service->show();
        } catch (Exception $e) {
            throw $e;
        }

        return response()->json($obj->toArray(), 200);
    }

    public function store()
    {
        try {
            $obj = $this->service->store();
        } catch (Exception $e) {
            throw $e;
        }

        return response()->json($obj->toArray(), 201);
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