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
        try {
            $this->repository->destroy($request);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->back();
        }

        alert()->success(trans($this->lang . '.destroyed'));
        return redirect()->route($this->routes . '.index', $request->route()->parameters());
    }

}
