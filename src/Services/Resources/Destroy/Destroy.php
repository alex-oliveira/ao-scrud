<?php

namespace AoScrud\Services\Resources\Destroy;

trait Destroy
{

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        try {
            $data = $this->rep->destroy(request()->route()->parameters());
        } catch (\Exception $e) {
            abort($e->getCode(), 'Falha inesperada ao tentar excluir o registro.');
        }

        return response()->json([], ($data ? 204 : 204));
    }

}