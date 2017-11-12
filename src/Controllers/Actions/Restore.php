<?php

namespace AoScrud\Controllers\Actions;

trait Restore
{

    public function restore()
    {
        $this->service->restore(AoScrud()->params()->all());
        return response()->json([], 204);
    }

}