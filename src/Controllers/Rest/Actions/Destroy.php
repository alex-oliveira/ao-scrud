<?php

namespace AoScrud\Controllers\Rest\Actions;

trait Destroy
{

    public function destroy()
    {
        try {
            $deleted = $this->api->destroy(array_merge(request()->all(), request()->route()->parameters()));
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json(['message' => 'None was deleted.'], ($deleted ? 204 : 200));
    }

}