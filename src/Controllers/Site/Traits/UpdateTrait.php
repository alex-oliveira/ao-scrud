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
        try {
            $result = $this->repository->update($request);
        } catch (\Exception $e) {
            if ($e instanceof JsonException) {
                alert()->danger(trans($this->lang . '.whoops'), $e->getMessageArray());
            } else {
                alert()->danger($e->getMessage());
            }
            return redirect()->back();
        }

        $p = $request->route()->parameters();
        if ($result) {
            alert()->success(trans($this->lang . '.updated', ['route' => route($this->routes . '.show', $p)]));
        } else {
            alert()->warning(trans($this->lang . '.unchanged', ['route' => route($this->routes . '.show', $p)]));
        }
        return redirect()->route($this->routes . '.index', $p);
    }

}
