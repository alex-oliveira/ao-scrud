<?php

namespace AoScrud\Controllers\Site\Actions;

trait Update
{

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update()
    {
        try {
            $changed = $this->api->update();
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->routes . '.edit', params()->all());
        }

        $route = ['route' => route($this->routes . '.show', params()->all())];
        if ($changed) {
            alert()->success(trans($this->langs . '.updated', $route));
        } else {
            alert()->warning(trans($this->langs . '.unchanged', $route));
        }

        return redirect()->route($this->routes . '.index', params()->forget('id'));
    }

}