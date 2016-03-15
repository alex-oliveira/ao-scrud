<?php

namespace AoScrud\Utils\Criteria\Search;

use AoScrud\Utils\Criteria\BaseCriteria;

class WithCriteria extends BaseCriteria
{

    /**
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Support\Collection $data
     * @param \AoScrud\Services\ScrudService $service
     * @return mixed
     */
    public function apply($query, $data, $service)
    {
        $allowWith = $service->getSearchWith();

        if (empty($allowWith))
            return $query;

        $approved = [];

        $withs = explode(';', $data->get('with', ''));
        foreach ($withs as $with) {
            $parts = explode(':', $with);

            if (!array_key_exists($parts[0], $allowWith))
                continue;

            $columns = $allowWith[$parts[0]];

            if (isset($parts[1]) && strlen($parts[1]) > 0) {
                $custom = array_intersect(explode(',', $parts[1]), $allowWith[$parts[0]]);
                count($custom) > 0 ? $columns = $custom : null;
            }

            $approved[$parts[0]] = function ($query) use ($columns) {
                $query->select($columns);
            };
        }

        if (count($approved) > 0)
            $query = $query->with($approved);

        return $query;
    }

}