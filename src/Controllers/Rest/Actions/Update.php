<?php

namespace AoScrud\Controllers\Rest\Actions;

trait Update
{

    public function update()
    {
        try {
            $updated = $this->api->update(array_merge(request()->all(), request()->route()->parameters()));
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json(['message' => 'None was changed.'], ($updated ? 204 : 200));
    }

}