<?php

namespace AoScrud\Controllers\Site\Traits;

trait ShowTrait
{

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show()
    {
        $data = $this->showData();

        try {
            $obj = $this->repository->read($data);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            $route = $this->routes . '.index';
            return redirect()->route($route, $this->routeParams($route, $data));
        }

        return view($this->views . '.show', compact('obj'));
    }

    /**
     * Return all parameters of the request.
     *
     * @return array
     */
    protected function showData()
    {
        return request()->route()->parameters();
    }

}
