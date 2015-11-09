<?php

namespace AoScrud\Controllers\Site\Traits;

trait EditTrait
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $obj = $this->repository->read($id);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->routes . '.index');
        }

        return view($this->views . '.edit', compact('obj'));
    }

}
