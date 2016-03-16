<?php

namespace AoScrud\Utils\Criteria;

class WithCriteria extends BaseCriteria
{

    /**
     * @var array
     */
    private $allowWith;

    /**
     * @param array $allowWith
     */
    public function __construct(array $allowWith)
    {
        $this->allowWith = $allowWith;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Support\Collection $data
     * @return mixed
     */
    public function apply($query, $data)
    {
        if (empty($this->allowWith))
            return $query;

        $approved = [];

        $withs = explode(';', $data->get('with', ''));
        foreach ($withs as $with) {
//            if (in_array($with, $this->allowWith)) {
//                $approved[] = $with;
//            }
            $parts = explode(':', $with);

            if (!array_key_exists($parts[0], $this->allowWith))
                continue;

            $columns = $this->allowWith[$parts[0]];

            if (isset($parts[1]) && strlen($parts[1]) > 0) {
                $custom = array_intersect(explode(',', $parts[1]), $this->allowWith[$parts[0]]);
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