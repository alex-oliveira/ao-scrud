<?php

namespace AoScrud\Repositories\Traits;

trait BaseTrait
{

    /**
     * Model of the Scrud name.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Return instance of main repository class.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function model()
    {
        return $this->model;
    }

}
