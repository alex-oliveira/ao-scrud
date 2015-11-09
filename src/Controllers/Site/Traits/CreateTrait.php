<?php

namespace AoScrud\Controllers\Site\Traits;

trait CreateTrait
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->views . '.create');
    }

}
