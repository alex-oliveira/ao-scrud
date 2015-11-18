<?php

namespace AoScrud\Controllers\Site\Traits;

use AoScrud\Exceptions\JsonException;

trait UpdateTrait
{

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        $data = $this->updateData();

        try {
            $result = $this->repository->update($data);
        } catch (\Exception $e) {
            if ($e instanceof JsonException) {
                alert()->danger(trans($this->lang . '.whoops'), $e->getMessageArray());
            } else {
                alert()->danger($e->getMessage());
            }
            return redirect()->back();
        }

        $route = $this->routes . '.show';
        $route = route($route, $this->routeParams($route, $data));
        if ($result) {
            alert()->success(trans($this->lang . '.updated', ['route' => $route]));
        } else {
            alert()->warning(trans($this->lang . '.unchanged', ['route' => $route]));
        }

        $route = $this->routes . '.index';
        return redirect()->route($route, $this->routeParams($route, $data));
    }

    /**
     * Return all parameters of the request.
     *
     * @return array
     */
    protected function updateData()
    {
        return array_merge(request()->all(), request()->route()->parameters());
    }

}
