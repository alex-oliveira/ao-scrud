<?php

namespace AoScrud\Controllers\Site\Traits;

use Illuminate\Http\Request;

trait EditTrait
{

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try {
            $obj = $this->repository->read($request);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->routes . '.index', $request->route()->parameters());
        }

        return view($this->views . '.edit', compact('obj'));
    }

}
