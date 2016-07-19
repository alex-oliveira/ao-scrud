<?php

namespace AoScrud\Actions;

trait Destroy
{

    public function destroy()
    {
        $this->service->destroy(scrud()->params());
        return response()->json([], 204);
    }

}