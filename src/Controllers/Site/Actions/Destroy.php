<?php

namespace AoScrud\Controllers\Site\Actions;

trait Destroy
{

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function destroy()
    {
        try {
            $status = $this->api->destroy();
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->back();
        }

        if ($status) {
            alert()->success(trans($this->langs . '.destroyed'));
            return redirect()->route($this->routes . '.index', params()->forget('id'));
        }

        alert()->success(trans($this->langs . '.not-destroyed'));
        return redirect()->back();

    }

}