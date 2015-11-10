<?php

namespace AoScrud\Controllers\Site\Traits;

use Illuminate\Http\Request;

trait IndexTrait
{

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $list = $this->repository->search($request);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->routeParent);
        }

        return view($this->views . '.index', compact('list'));
    }

}
