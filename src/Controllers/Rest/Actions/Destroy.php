<?php

namespace AoScrud\Controllers\Rest\Actions;

trait Destroy
{

    public function destroy()
    {
        $deleted = $this->api->destroy(array_merge(request()->all(), request()->route()->parameters()));
        return response()->json([], ($deleted ? 204 : 200));
    }

}