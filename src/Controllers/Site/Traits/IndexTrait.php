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
        $data = array_merge($request->all(), $request->route()->parameters());

        try {
            $list = $this->repository->search($data);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route((isset($this->routeParent) ? $this->routeParent : 'home'));
        }

        return view($this->views . '.index', compact('list'));
    }

}
