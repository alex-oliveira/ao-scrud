<?php

namespace AoScrud\Controllers\Site\Traits;

trait EditTrait
{

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit()
    {
        $data = request()->route()->parameters();

        try {
            $obj = $this->repository->read($data);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->editRoute(), $this->params($this->editRoute()));
        }

        return view($this->views . '.edit', compact('obj'));
    }

    protected function editRoute()
    {
        return $this->routes . '.index';
    }

}
