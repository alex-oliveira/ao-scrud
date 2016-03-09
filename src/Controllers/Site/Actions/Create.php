<?php

namespace AoScrud\Controllers\Site\Actions;

trait Create
{

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view($this->views . '.create');
    }

}