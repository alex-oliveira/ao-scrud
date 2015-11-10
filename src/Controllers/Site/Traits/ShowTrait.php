<?php

namespace AoScrud\Controllers\Site\Traits;

use Illuminate\Http\Request;

trait ShowTrait
{

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $params = $request->route()->parameters();
        $data = array_merge($request->all(), $params);

        try {
            $obj = $this->repository->read($data);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->routes . '.index', $params);
        }

        return view($this->views . '.show', compact('obj'));
    }

}
