<?php

namespace AoScrud\Services\Resources\Search;

use AoScrud\Tools\Criteria\RouteParamsCriteria;
use AoScrud\Tools\Criteria\SearchCriteria;

trait Search
{

    public function search($data = null)
    {
        $data = collect(is_null($data) ? array_merge(request()->all(), request()->route()->parameters()) : $data);

        $this->searchCustom($data);

        try {
            $result = $this->rep->paginate();
        } catch (\Exception $e) {
            throw new \Exception('Falha inesperada ao tentar realizar a pesquisa.', 500, $e);
        }

        return $result;
    }

    /**
     * @param \Illuminate\Support\Collection $data
     */
    public function searchCustom($data)
    {
        //$this->rep->pushCriteria(new RouteParamsCriteria());
        $this->rep->pushCriteria(new SearchCriteria($data));
    }

}