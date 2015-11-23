<?php

namespace AoScrud\Services\Resources\Update;

trait Update
{

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        try {
            $data = $this->rep->upgrade(request()->all(), request()->route()->parameters());
        } catch (\Exception $e) {
            abort($e->getCode(), 'Falha inesperada ao tentar cadastrar o registro.');
        }

        return $data;
    }

}