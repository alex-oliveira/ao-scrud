<?php

namespace AoScrud\Repositories\Criteria;

class WithCriteria extends BaseCriteria
{

//     * @param \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Query\Builder $query
    /**
     * @param \AoScrud\Repositories\BaseRepository $rep
     * @return mixed
     */
    public function apply($rep)
    {
//        if ($rep->with()->isEmpty())
//            return $query;
//
//        $approved = [];
//
//        $list = explode('|', $data->get('with', ''));
//        foreach ($list as $with) {
////            if (in_array($with, $this->allowWith)) {
////                $approved[] = $with;
////            }
//            $parts = explode(':', $with);
//
//            if (!$rep->with()->has($parts[0]))
//                continue;
//
//            $columns = $rep->with()->get($parts[0]);
//
//            if (isset($parts[1]) && strlen($parts[1]) > 0) {
//                $custom = array_intersect(explode(',', $parts[1]), $rep->with()->get($parts[0]));
//                count($custom) > 0 ? $columns = $custom : null;
//            }
//
//            $approved[$parts[0]] = function ($query) use ($columns) {
//                $query->select($columns);
//            };
//        }
//
//        if (count($approved) > 0)
//            $query = $query->with($approved);
//
//        return $query;
    }

}