<?php

namespace AoScrud\Actions\Site;

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