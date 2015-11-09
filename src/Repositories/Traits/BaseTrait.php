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
     * Array with the labels for the fields.
     *
     * @var array
     */
    protected $labels;

    /**
     * Return instance of main repository class.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * Return an array with the labels for the fields.
     *
     * @return array
     */
    public function labels()
    {
        return $this->labels;
    }

    /**
     * Return all items.
     *
     * @return array
     */
    public function all()
    {
        return $this->model->all();
    }

}
