<?php

namespace AoScrud\Controllers\Site\Traits;

trait ShowTrait
{

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $obj = $this->repository->read($id);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->routes . '.index');
        }

        return view($this->views . '.show', compact('obj'));
    }

}
