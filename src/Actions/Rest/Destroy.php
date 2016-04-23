<?php

namespace AoScrud\Actions\Rest;

trait Destroy
{

    public function destroy()
    {
        $this->service->tEnable()->destroy(array_merge(request()->all(), request()->route()->parameters()));
        return response()->json([], 204);
    }

}