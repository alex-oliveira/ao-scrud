<?php

namespace AoScrud\Controllers\Rest\Actions;

trait Destroy
{

    public function destroy()
    {
        try {
            $this->api->destroy(collect(array_merge(request()->all(), request()->route()->parameters())));
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([], 204);
    }

}