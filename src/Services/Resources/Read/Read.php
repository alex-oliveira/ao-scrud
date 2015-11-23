<?php

namespace AoScrud\Services\Resources\Read;

use AoScrud\Tools\Criteria\RouteParamsCriteria;

trait Read
{

    public function read($params = null, $columns = null)
    {
        //$this->readCriteria($params);
        //$this->readColumns($columns);

        try {
            $this->rep->pushCriteria(new RouteParamsCriteria());
            $obj = $this->rep->find(params()->get('id'));
        } catch (\Exception $e) {
            throw new \Exception('Falha inesperada ao tentar recuperar o registro.', 404, $e);
        }

        return $obj;
    }

}