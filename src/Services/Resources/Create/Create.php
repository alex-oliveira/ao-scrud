<?php

namespace AoScrud\Services\Resources\Create;

use Illuminate\Support\Collection;

trait Create
{

    /**
     * @param array|null $data
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function create(array $data = null)
    {
        $data = collect(is_null($data) ? array_merge(request()->all(), request()->route()->parameters()) : $data);

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

    /**
     * @param Collection $data
     * @return array
     */
    protected function createFilter($data)
    {
        return array_merge(request()->all(), request()->route()->parameters());
    }

}