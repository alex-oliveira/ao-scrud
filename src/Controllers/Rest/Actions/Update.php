<?php

namespace AoScrud\Controllers\Rest\Actions;

trait Update
{

    public function update()
    {
        try {
            $changed = $this->api->update();
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([], ($changed ? 200 : 204));
    }

}