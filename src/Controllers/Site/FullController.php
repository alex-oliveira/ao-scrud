<?php

namespace AoScrud\Controllers\Site;

class FullController extends BaseController
{

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        try {
            $result = $this->service->search();
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->main);
        }

        return view($this->views . '.index', compact('result'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view($this->views . '.create');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store()
    {
        try {
            $obj = $this->service->create();
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->back()->withInput();
        }

        alert()->success(trans($this->langs . '.created', ['route' => $obj->id]));
        return redirect()->route($this->routes . '.index', params()->forget('id'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show()
    {
        try {
            $obj = $this->service->read();
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->routes . '.index', params()->forget('id'));
        }

        return view($this->views . '.show', compact('obj'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit()
    {
        try {
            $obj = $this->service->read();
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->routes . '.index', params()->forget('id'));
        }

        return view($this->views . '.edit', compact('obj'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update()
    {
        try {
            $status = $this->service->update();
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->routes . '.edit', params()->all());
        }

        $route = ['route' => route($this->routes . '.show', params()->all())];
        if ($status) {
            alert()->success(trans($this->langs . '.updated', $route));
        } else {
            alert()->warning(trans($this->langs . '.unchanged', $route));
        }

        return redirect()->route($this->routes . '.index', params()->forget('id'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function delete()
    {
        try {
            $data = $this->service->delete();
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->routes . '.index', params()->forget('id'));
        }

        return view($this->views . '.delete', compact('data'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function destroy()
    {
        try {
            $status = $this->service->destroy();
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