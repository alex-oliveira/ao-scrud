<?php

namespace AoScrud\Controllers\Site\Traits;

trait EditTrait
{

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit()
    {
        $data = $this->editData();

        try {
            $obj = $this->repository->read($data);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            $route = $this->routes . '.index';
            return redirect()->route($route, $this->routeParams($route, $data));
        }

        return view($this->views . '.edit', compact('obj'));
    }

    /**
     * Return all parameters of the request.
     *
     * @return array
     */
    protected function editData()
    {
        return request()->route()->parameters();
    }

}
