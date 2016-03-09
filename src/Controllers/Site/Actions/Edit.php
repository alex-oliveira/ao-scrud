<?php

namespace AoScrud\Controllers\Site\Actions;

trait Edit
{

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit()
    {
        try {
            $obj = $this->api->read();
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->routes . '.index', params()->forget('id'));
        }

        return view($this->views . '.edit', compact('obj'));
    }

}