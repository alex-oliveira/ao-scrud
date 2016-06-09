<?php

namespace AoScrud\Actions;

trait Destroy
{

    public function destroy()
    {
        $this->service->destroy(array_merge(request()->all(), request()->route()->parameters()));
        return response()->json([], 204);
    }

}