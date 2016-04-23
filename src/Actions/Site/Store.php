<?php

namespace AoScrud\Actions\Site;

trait Store
{

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store()
    {
        try {
            $obj = $this->service->tEnable()->create();
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->back()->withInput();
        }

        alert()->success(trans($this->langs . '.created', ['route' => $obj->id]));
        return redirect()->route($this->routes . '.index', params()->forget('id'));
    }

}