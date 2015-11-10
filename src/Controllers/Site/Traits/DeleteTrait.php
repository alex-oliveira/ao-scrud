<?php

namespace AoScrud\Controllers\Site\Traits;

use Illuminate\Http\Request;

trait DeleteTrait
{

    /**
     * Remove confirm the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $params = $request->route()->parameters();
        $data = array_merge($request->all(), $params);

        try {
            $obj = $this->repository->read($data);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->routes . '.index', $params);
        }

        return view($this->views . '.delete', compact('obj'));
    }

}
