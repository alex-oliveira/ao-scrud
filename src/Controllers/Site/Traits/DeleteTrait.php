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
        $data = request()->route()->parameters();

        try {
            $obj = $this->repository->read($data);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->deleteRouteError(), $this->params($this->deleteRouteError()));
        }

        return view($this->views . '.delete', compact('obj'));
    }

    protected function deleteRouteError()
    {
        return $this->routes . '.index';
    }

}
