<?php

namespace AoScrud\Actions\Site;

trait Show
{

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show()
    {
        try {
            $obj = $this->service->tEnable()->read();
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->routes . '.index', params()->forget('id'));
        }

        return view($this->views . '.show', compact('obj'));
    }

}