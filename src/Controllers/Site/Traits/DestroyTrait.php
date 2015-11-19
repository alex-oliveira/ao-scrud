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
        $data = request()->route()->parameters();

        try {
            $this->repository->destroy($data);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->back();
        }

        alert()->success(trans($this->lang . '.destroyed'));
        return redirect()->route($this->destroyRoute(), $this->params($this->destroyRoute()));
    }

    protected function destroyRoute()
    {
        return $this->routes . '.index';
    }

}
