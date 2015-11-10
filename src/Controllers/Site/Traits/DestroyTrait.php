<?php

namespace AoScrud\Controllers\Site\Traits;

use Illuminate\Http\Request;

trait DestroyTrait
{

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $params = $request->route()->parameters();
        $data = array_merge($request->all(), $params);

        try {
            $this->repository->destroy($data);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->back();
        }

        alert()->success(trans($this->lang . '.destroyed'));
        return redirect()->route($this->routes . '.index', $params);
    }

}
