<?php

namespace AoScrud\Controllers\Rest\Actions;

trait Update
{

    public function update()
    {
        try {
            $changed = $this->api->update(collect(array_merge(request()->all(), request()->route()->parameters())));
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([], ($changed ? 200 : 204));
        //return response()->json([], 204)->header('x-changed', $changed);
    }

}