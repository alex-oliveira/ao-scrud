<?php

namespace AoScrud\Services\Resources\Create;

trait Create
{

    public function create($data = null)
    {
        $data = collect((is_null($data) ? self::data() : $data));

        $this->createFilter($data);
        $this->createTransformer($data);
        $this->createValidator($data);

        $this->tBegin();
        try {
            $obj = $this->createSave($data);
        } catch (\Exception $e) {
            $this->tRollBack();
            throw new \Exception('falha ao tentar cadastrar', 500, $e);
        }
        $this->tCommit();

        return $obj;
    }

}