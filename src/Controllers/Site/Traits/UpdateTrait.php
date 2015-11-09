<?php

namespace AoScrud\Controllers\Site\Traits;

use AoScrud\Exceptions\JsonException;
use Illuminate\Http\Request;

trait UpdateTrait
{

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $result = $this->repository->update($id, $request->input('obj'));
        } catch (\Exception $e) {
            if ($e instanceof JsonException) {
                alert()->danger(trans($this->lang . '.whoops'), $e->getMessageArray());
            } else {
                alert()->danger($e->getMessage());
            }
            return redirect()->route($this->routes . '.edit', ['id' => $id]);
        }

        $params = ['route' => route($this->routes . '.show', ['id' => $id])];
        if ($result) {
            alert()->success(trans($this->lang . '.updated', $params));
        } else {
            alert()->warning(trans($this->lang . '.unchanged', $params));
        }
        return redirect()->route($this->routes . '.index');
    }

}
