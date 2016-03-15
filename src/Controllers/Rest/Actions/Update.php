<?php

namespace AoScrud\Controllers\Rest\Actions;

trait Update
{

    public function update()
    {
        $updated = $this->api->update(array_merge(request()->all(), request()->route()->parameters()));
        return response()->json([], ($updated ? 204 : 200));
    }

}