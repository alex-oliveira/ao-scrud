<?php

namespace AoScrud\Actions\Rest;

trait Update
{

    public function update()
    {
        $updated = $this->service->tEnable()->update(array_merge(request()->all(), request()->route()->parameters()));
        return response()->json(['updated' => false], ($updated ? 204 : 200));
    }

}