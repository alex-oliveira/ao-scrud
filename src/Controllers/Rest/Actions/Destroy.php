<?php

namespace AoScrud\Controllers\Rest\Actions;

trait Destroy
{

    public function destroy()
    {
        try {
            $this->api->destroy();
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([], 204);
    }

}