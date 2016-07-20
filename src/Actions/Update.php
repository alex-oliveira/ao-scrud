<?php

namespace AoScrud\Actions;

trait Update
{

    public function update()
    {
        $updated = $this->service->update(scrud()->params()->all());
        return response()->json([], ($updated ? 204 : 200));
    }

}