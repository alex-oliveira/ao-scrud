<?php

namespace AoScrud\Controllers\Site\Traits;

trait IndexTrait
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        try {
            $list = $this->repository->search($this->indexData());
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route('home');
        }

        return view($this->views . '.index', compact('list'));
    }

    /**
     * Return all parameters of the request.
     *
     * @return array
     */
    protected function indexData()
    {
        return array_merge(request()->all(), request()->route()->parameters());
    }

}
