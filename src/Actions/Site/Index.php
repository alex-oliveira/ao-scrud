<?php

namespace AoScrud\Actions\Site;

trait Index
{

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        try {
            $result = $this->service->tEnable()->search();
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->main);
        }

        return view($this->views . '.index', compact('result'));
    }

}