<?php

namespace AoScrud\Controllers\Site\Traits;

use AoScrud\Exceptions\JsonException;
use Illuminate\Http\Request;

trait UpdateTrait
{

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $params = $request->route()->parameters();
        $data = array_merge($request->all(), $params);

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

        $route = route($this->routes . '.show', $params);
        if ($result) {
            alert()->success(trans($this->lang . '.updated', ['route' => $route]));
        } else {
            alert()->warning(trans($this->lang . '.unchanged', ['route' => $route]));
        }
        return redirect()->route($this->routes . '.index', $params);
    }

}
