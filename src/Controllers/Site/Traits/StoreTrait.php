<?php

namespace AoScrud\Controllers\Site\Traits;

use AoScrud\Exceptions\JsonException;
use Illuminate\Http\Request;

trait StoreTrait
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $obj = $this->repository->create($request->input('obj'));
        } catch (\Exception $e) {
            if ($e instanceof JsonException) {
                alert()->danger(trans($this->lang . '.whoops'), $e->getMessageArray());
            } else {
                alert()->danger($e->getMessage());
            }
            return redirect()->route($this->routes . '.create')->withInput();
        }

        alert()->success(trans($this->lang . '.created', ['route' => route($this->routes . '.show', ['id' => $obj->id])]));
        return redirect()->route($this->routes . '.index');
    }

}
