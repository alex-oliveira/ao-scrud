<?php

namespace AoScrud\Controllers\Rest;

use Exception;

class FullController extends BaseController
{

    public function index()
    {
        try {
            $result = $this->service->search()->toArray();
        } catch (Exception $e) {
            throw $e;
        }

        return response()->json($result['data'], 200)
            ->header('x-total', $result['total'])
            ->header('x-per-page', $result['per_page'])
            ->header('x-current-page', $result['current_page'])
            ->header('x-last-page', $result['last_page'])
            ->header('x-next-page-url', $result['next_page_url'])
            ->header('x-prev-page-url', $result['prev_page_url'])
            ->header('x-from', $result['from'])
            ->header('x-to', $result['to']);
    }


    public function store()
    {
        try {
            $obj = $this->service->create();
        } catch (Exception $e) {
            throw $e;
        }

        return response()->json($obj->toArray(), 201);
    }

    public function show()
    {
        try {
            $obj = $this->service->read();
        } catch (Exception $e) {
            throw $e;
        }

        return response()->json($obj->toArray(), 200);
    }

    public function update()
    {
        try {
            $status = $this->service->update();
        } catch (Exception $e) {
            throw $e;
        }

        return response()->json([], ($status ? 204 : 304));
    }

    public function destroy()
    {
        try {
            $status = $this->service->destroy();
        } catch (Exception $e) {
            throw $e;
        }

        return response()->json([], ($status ? 204 : 304));
    }

}