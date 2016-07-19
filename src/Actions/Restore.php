<?php

namespace AoScrud\Actions;

trait Restore
{

    public function restore()
    {
        $this->service->restore(scrud()->params());
        return response()->json([], 204);
    }

}