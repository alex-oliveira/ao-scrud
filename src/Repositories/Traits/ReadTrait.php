<?php

namespace AoScrud\Repositories\Traits;

trait ReadTrait
{

    /**
     * Read method.
     *
     * @@param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function read(array $data)
    {
        $data = collect($data);

        # wheres
        $query = $this->model()->where(function ($query) use ($data) {
            $this->readWhere($query, $data);
        });

        # pagination
        $obj = $query->get()->first();

        if (empty($obj))
            abort(404, '<b>Registro não existe</b> ou não pode ser selecionado.');

        return $obj;
    }

    /**
     * Add research rules.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Support\Collection $data
     */
    protected function readWhere($query, $data)
    {
        //if (is_null($this->map)) {
        //    $ids = ['idj', 'idi', 'idh', 'idg', 'idf', 'ide', 'idd', 'idc', 'idb', 'id'];
        //    foreach ($ids as $id) {
        //        if ($data->has($id)) {
        //            $this->readKeys = [$id => 'id'];
        //            break;
        //        }
        //    }
        //}

        foreach ($this->map as $param => $field) {
            $query->where($field, $data->get($param, false));
        }
    }

}
