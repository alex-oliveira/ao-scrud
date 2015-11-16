<?php

namespace AoScrud\Controllers\Site\Traits;

use AoScrud\Exceptions\JsonException;
use Illuminate\Http\Request;

trait StoreTrait
{

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->route()->parameters();
        $data = array_merge($request->all(), $params);

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

        alert()->success(trans($this->lang . '.created', ['route' => $this->storeRouteShow($data, $obj)]));
        return redirect()->route($this->routes . '.index', $params);
    }

    /**
     * Return a route to show the created object.
     *
     * @param array $data
     * @param \Illuminate\Database\Eloquent\Model $obj
     * @return \Illuminate\Routing\Route
     */
    protected function storeRouteShow(array $data, $obj)
    {
        $data = collect($data);

        $id = $data->get('id', false);
        $idb = $data->get('idb', false);

        if ($idb) {
            $r = route($this->routes . '.show', ['id' => $id, 'idb' => $idb, 'idc' => $obj->id]);

        } elseif ($id) {
            $r = route($this->routes . '.show', ['id' => $id, 'idb' => $obj->id]);

        } else {
            $r = route($this->routes . '.show', ['id' => $obj->id]);

        }

        return $r;
    }

}
