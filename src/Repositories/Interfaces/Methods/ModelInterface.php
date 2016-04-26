<?php

namespace AoScrud\Repositories\Interfaces\Methods;

interface ModelInterface
{

    /**
     * @param string|null $model
     * @return $this|string
     */
    public function model($model = null);

    /**
     * @return string
     */
    public function getModel();

    /**
     * @param string $model
     * @return $this
     */
    public function setModel($model);

}