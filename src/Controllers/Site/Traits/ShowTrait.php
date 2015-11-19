<?php

namespace AoScrud\Controllers\Site\Traits;

trait ShowTrait
{

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show()
    {
        $data = request()->route()->parameters();

        try {
            $obj = $this->repository->read($data);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->showRoute(), $this->params($this->showRoute()));
        }

        return view($this->views . '.show', compact('obj'));
    }

    protected function showRoute()
    {
        return $this->routes . '.index';
    }

}
