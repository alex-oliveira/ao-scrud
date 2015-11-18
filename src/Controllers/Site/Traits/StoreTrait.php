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
        $data = $this->storeData();

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

        alert()->success(trans($this->lang . '.created', ['route' => $this->storeRouteShow($obj, $data)]));
        $route = $this->routes . '.index';
        return redirect()->route($route, $this->routeParams($route, $data));
    }

    /**
     * Return all parameters of the request.
     *
     * @return array
     */
    protected function storeData()
    {
        return array_merge(request()->all(), request()->route()->parameters());
    }

    /**
     * Return a route to show the created object.
     *
     * @param \Illuminate\Database\Eloquent\Model $obj
     * @param array $data
     * @return \Illuminate\Routing\Route
     */
    protected function storeRouteShow($obj, array $data = [])
    {
        $route = $this->routes . '.show';
        $params = $this->routeParams($route, $data);

        $ids = ['id', 'idb', 'idc', 'idd', 'ide', 'idf', 'idg', 'idh', 'idi', 'idj'];
        foreach ($ids as $id) {
            if (!isset($params[$id])) {
                $params[$id] = $obj->id;
                break;
            }
        }

        return route($route, $params);
    }

}
