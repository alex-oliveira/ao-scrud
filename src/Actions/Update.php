<?php

namespace AoScrud\Actions;

trait Update
{

    public function update()
    {
        $updated = $this->service->update(array_merge(request()->all(), request()->route()->parameters()));
        return response()->json(['updated' => false], ($updated ? 204 : 200));
    }

}