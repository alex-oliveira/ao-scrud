<?php

namespace AoScrud\Actions;

trait Restore
{

    public function restore()
    {
        $this->service->restore(array_merge(request()->all(), request()->route()->parameters()));
        return response()->json([], 204);
    }

}