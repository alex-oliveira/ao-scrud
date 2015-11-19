<?php

namespace AoScrud\Controllers\Site\Traits;

use AoScrud\Exceptions\JsonException;

trait StoreTrait
{

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store()
    {
        $params = request()->route()->parameters();
        $data = array_merge(request()->all(), $params);

        try {
            $obj = $this->repository->create($data);
        } catch (\Exception $e) {
            if ($e instanceof JsonException) {
                alert()->danger(trans($this->lang . '.whoops'), $e->getMessageArray());
            } else {
                alert()->danger($e->getMessage());
            }
            return redirect()->back()->withInput();
        }

        foreach (['id', 'idb', 'idc', 'idd', 'ide', 'idf', 'idg', 'idh', 'idi', 'idj'] as $id) {
            if (empty($params[$id])) {
                $params[$id] = $obj->id;
                break;
            }
        }

        alert()->success(trans($this->lang . '.created', ['route' => route($this->routes . '.show', $params)]));
        return redirect()->route($this->storeRoute(), $this->params($this->storeRoute()));
    }

    protected function storeRoute()
    {
        return $this->routes . '.index';
    }

}
