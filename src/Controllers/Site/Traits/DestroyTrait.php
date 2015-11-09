<?php

namespace AoScrud\Controllers\Site\Traits;

trait DestroyTrait
{

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->destroy($id);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->routes . '.delete', ['id' => $id]);
        }

        alert()->success(trans($this->lang . '.destroyed'));
        return redirect()->route($this->routes . '.index');
    }

}
