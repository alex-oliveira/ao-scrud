<?php

namespace AoScrud\Controllers\Site\Traits;

trait DeleteTrait
{

    /**
     * Remove confirm the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function delete()
    {
        $data = $this->deleteData();

        try {
            $obj = $this->repository->read($data);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            $route = $this->routes . '.index';
            return redirect()->route($route, $this->routeParams($route, $data));
        }

        return view($this->views . '.delete', compact('obj'));
    }

    /**
     * Return all parameters of the request.
     *
     * @return array
     */
    protected function deleteData()
    {
        return request()->route()->parameters();
    }

}
