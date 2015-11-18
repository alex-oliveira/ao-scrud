<?php

namespace AoScrud\Controllers\Site\Traits;

trait DestroyTrait
{

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        $data = $this->destroyData();

        try {
            $this->repository->destroy($data);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->back();
        }

        alert()->success(trans($this->lang . '.destroyed'));
        $route = $this->routes . '.index';
        return redirect()->route($route, $this->routeParams($route, $data));
    }

    /**
     * Return all parameters of the request.
     *
     * @return array
     */
    protected function destroyData()
    {
        return request()->route()->parameters();
    }

}
