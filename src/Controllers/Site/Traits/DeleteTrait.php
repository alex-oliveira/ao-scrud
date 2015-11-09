<?php

namespace AoScrud\Controllers\Site\Traits;

trait DeleteTrait
{

    /**
     * Remove confirm the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $obj = $this->repository->read($id);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->routes . '.index');
        }

        return view($this->views . '.delete', compact('obj'));
    }

}
