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
     * Return the Scrud model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * <description>
     *
     * @param  array|\Illuminate\Database\Eloquent\Collection $data
     * @return string
     */
    public function xId($data)
    {
        if (is_array($data))
            $data = collect($data);

        return $data->get('ide', $data->get('idd', $data->get('idc', $data->get('idb', $data->get('id')))));
    }

}
