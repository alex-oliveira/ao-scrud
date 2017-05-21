<?php

namespace AoScrud\Actions;

trait Destroy
{

    public function destroy()
    {
        $this->service->destroy(AoScrud()->params()->all());
        return response()->json([], 204);
    }

}