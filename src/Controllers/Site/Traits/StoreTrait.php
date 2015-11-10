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
        try {
            $obj = $this->repository->create($request);
        } catch (\Exception $e) {
            if ($e instanceof JsonException) {
                alert()->danger(trans($this->lang . '.whoops'), $e->getMessageArray());
            } else {
                alert()->danger($e->getMessage());
            }
            return redirect()->back()->withInput();
        }

        $p = $request->route()->parameters();
        //alert()->success(trans($this->lang . '.created', ['route' => route($this->routes . '.show', ['id' => $obj->id])]));
        return redirect()->route($this->routes . '.index', $p);
    }

}
