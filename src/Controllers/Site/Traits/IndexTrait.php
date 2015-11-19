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
        $data = array_merge(request()->all(), request()->route()->parameters());

        try {
            $list = $this->repository->search($data);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->indexRoute());
        }

        return view($this->views . '.index', compact('list'));
    }

    protected function indexRoute()
    {
        return 'home';
    }

}
