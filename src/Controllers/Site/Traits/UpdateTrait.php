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
        $data = array_merge(request()->all(), request()->route()->parameters());

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

        $route = route($this->routes . '.show', request()->route()->parameters());
        if ($result) {
            alert()->success(trans($this->lang . '.updated', compact('route')));
        } else {
            alert()->warning(trans($this->lang . '.unchanged', compact('route')));
        }

        return redirect()->route($this->updateRoute(), $this->params($this->updateRoute()));
    }

    protected function updateRoute()
    {
        return $this->routes . '.index';
    }

}
