<?php

namespace AoScrud\Repositories\Traits;

trait BaseTrait
{
    /**
     *
     * id => id
     *
     * or
     *
     * id => user_id
     * idb => id
     *
     * or
     *
     * id => user_id
     * idb => comment_id
     * idc => id
     *
     * @var array
     */
    public $map = ['id' => 'id'];

    /**
     * Model of the Scrud name.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Return the Scrud model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function model()
    {
        return $this->model;
    }

}
