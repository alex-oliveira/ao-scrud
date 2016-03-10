<?php

namespace AoScrud\Controllers\Rest\Actions;

trait Update
{

    public function update()
    {
        $keys = request()->route()->parameters();

        try {
            $changed = $this->api->update(collect(array_merge(request()->all(), $keys)), collect($keys));
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([], ($changed ? 200 : 204));
    }

}