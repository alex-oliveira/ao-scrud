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
     * Return an array with the labels for the fields.
     *
     * @return array
     */
    public function labels()
    {
        return $this->model->labels();
    }

    /**
     * Get all of the models from the database.
     *
     * @param  array|mixed  $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($columns = ['*'])
    {
        return $this->model->all($columns);
    }

}
