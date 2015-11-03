<?php

namespace AoScrud\Repositories\Traits;

trait BaseTrait
{

    /**
     * Model of the Scrud name.
     *
     * @var \Illuminate\Database\Eloquent\Model::class
     */
    protected $model;

    /**
     * Singleton of the Scrud.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    private $singleton;

    /**
     * Return instance of main repository class.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function model()
    {
        return is_null($this->singleton) ? $this->singleton = app()->make($this->model) : $this->singleton;
    }

}
