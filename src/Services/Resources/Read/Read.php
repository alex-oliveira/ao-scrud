<?php

namespace AoScrud\Services\Resources\Read;

use AoScrud\Tools\Criteria\ModelColumnsCriteria;
use AoScrud\Tools\Criteria\ModelWithCriteria;
use AoScrud\Tools\Criteria\RouteParamsCriteria;

trait Read
{

    protected $readColumns = [];
    protected $readWith = [];

    //------------------------------------------------------------------------------------------------------------------

    public function read()
    {
        $this->readCustom();

        try {
            $obj = $this->readExecute();
        } catch (\Exception $e) {
            throw new \Exception('Falha inesperada ao tentar recuperar o registro.', 404, $e);
        }

        return $obj;
    }

    protected function readCustom()
    {
        $this->rep->pushCriteria(new RouteParamsCriteria());
        $this->rep->pushCriteria(new ModelColumnsCriteria($this->getReadColumns()));
        $this->rep->pushCriteria(new ModelWithCriteria($this->getReadWith()));
    }

    protected function readExecute()
    {
        return $this->rep->find(params()->get('id'));
    }

    //------------------------------------------------------------------------------------------------------------------

    public function getReadColumns()
    {
        return $this->readColumns;
    }

    public function getReadWith()
    {
        return $this->readWith;
    }

}