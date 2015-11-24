<?php

namespace AoScrud\Tools\Criteria;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class SearchCriteria implements CriteriaInterface
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var RepositoryInterface;
     */
    protected $rep;

    /**
     * @var Collection;
     */
    protected $config;

    /**
     * @var Collection;
     */
    protected $data;

    /**
     * @param Collection $config
     * @param Collection $data
     */
    public function __construct(Collection $config, Collection $data)
    {
        $this->config = $config;
        $this->data = $data;
    }

    public function apply($model, RepositoryInterface $rep)
    {
        $this->model = $model;
        $this->rep = $rep;

        $this->filter();
        $this->columns();
        $this->order();
        $this->limit();
        $this->with();

        return $this->model;
    }

    protected function filter()
    {
        if (is_null($q = $this->request->get('q', null)))
            return;

        $fields = $this->request->only($this->rep->getFieldsSearchable());

        dd($this->rep->getFieldsSearchable());
    }

    protected function columns()
    {
        if (is_null($columns = $this->data->get('columns', null)))
            return;

        $columns = array_intersect(explode(';', $columns), $this->config->get('columns', []));
        if (count($columns) > 0)
            $this->model = $this->model->select($columns);
    }

    protected function order()
    {
        if (is_null($field = $this->data->get('order', null)))
            return;

        if (in_array($field, $this->config->get('orders', [])))
            $this->model = $this->model->orderBy($field, ($this->data->get('sort') == 'desc' ? 'desc' : 'asc'));
    }

    protected function limit()
    {
        $page = $this->data->get('page', 1);
        if (!(is_numeric($page) && is_int($page + 0) && $page > 0)) {
            $page = 1;
        }

        $limit = $this->data->get('limit', 15);
        if (!(is_numeric($limit) && is_int($limit + 0) && $limit > 0 && $limit <= 50)) {
            $limit = 15;
        }

        $offset = ($page - 1) * $limit;
        $this->model = $this->model->skipt($offset)->take($limit);
    }

    protected function with()
    {
        if (is_null($with = $this->data->get('with', null)))
            return;

        $with = array_intersect(explode(';', $with), $this->config->get('with', []));
        if (count($with) > 0)
            $this->model = $this->model->with($with);
    }

//        $fieldsSearchable   = $repository->getFieldsSearchable();
//        $search             = $this->request->get( config('repository.criteria.params.search','search') , null);
//        $searchFields       = $this->request->get( config('repository.criteria.params.searchFields','searchFields') , null);
//        $filter             = $this->request->get( config('repository.criteria.params.filter','filter') , null);
//        $orderBy            = $this->request->get( config('repository.criteria.params.orderBy','orderBy') , null);
//        $sortedBy           = $this->request->get( config('repository.criteria.params.sortedBy','sortedBy') , 'asc');
//        $with               = $this->request->get( config('repository.criteria.params.with','with') , null);
//        $sortedBy           = !empty($sortedBy) ? $sortedBy : 'asc';
//
//        if ( $search && is_array($fieldsSearchable) && count($fieldsSearchable) )
//        {
//
//            $searchFields       = is_array($searchFields) || is_null($searchFields) ? $searchFields : explode(';',$searchFields);
//            $fields             = $this->parserFieldsSearch($fieldsSearchable, $searchFields);
//            $isFirstField       = true;
//            $searchData         = $this->parserSearchData($search);
//            $search             = $this->parserSearchValue($search);
//            $modelForceAndWhere = false;
//
//            $model = $model->where(function ($query) use($fields, $search, $searchData, $isFirstField, $modelForceAndWhere) {
//                foreach ($fields as $field=>$condition) {
//
//                    if (is_numeric($field)){
//                        $field = $condition;
//                        $condition = "=";
//                    }
//
//                    $value = null;
//
//                    $condition  = trim(strtolower($condition));
//
//                    if ( isset($searchData[$field]) ) {
//                        $value = $condition == "like" ? "%{$searchData[$field]}%" : $searchData[$field];
//                    } else {
//                        if ( !is_null($search) ) {
//                            $value = $condition == "like" ? "%{$search}%" : $search;
//                        }
//                    }
//
//                    if ( $isFirstField || $modelForceAndWhere ) {
//                        if (!is_null($value)) {
//                            $query->where($field,$condition,$value);
//                            $isFirstField = false;
//                        }
//                    } else {
//                        if (!is_null($value)) {
//                            $query->orWhere($field,$condition,$value);
//                        }
//                    }
//                }
//            });
//        }
//
//        return $model;

    /**
     * @param $search
     * @return array
     */
    protected function parserSearchData($search)
    {
        $searchData = [];

        if (stripos($search, ':')) {
            $fields = explode(';', $search);

            foreach ($fields as $row) {
                try {
                    list($field, $value) = explode(':', $row);
                    $searchData[$field] = $value;
                } catch (\Exception $e) {
                    //Surround offset error
                }
            }
        }

        return $searchData;
    }

    /**
     * @param $search
     * @return null
     */
    protected function parserSearchValue($search)
    {

        if (stripos($search, ';') || stripos($search, ':')) {
            $values = explode(';', $search);
            foreach ($values as $value) {
                $s = explode(':', $value);
                if (count($s) == 1) {
                    return $s[0];
                }
            }

            return null;
        }

        return $search;
    }

    protected function parserFieldsSearch(array $fields = array(), array $searchFields = null)
    {
        if (!is_null($searchFields) && count($searchFields)) {
            $acceptedConditions = config('repository.criteria.acceptedConditions', array('=', 'like'));
            $originalFields = $fields;
            $fields = [];

            foreach ($searchFields as $index => $field) {
                $field_parts = explode(':', $field);
                $_index = array_search($field_parts[0], $originalFields);

                if (count($field_parts) == 2) {
                    if (in_array($field_parts[1], $acceptedConditions)) {
                        unset($originalFields[$_index]);
                        $field = $field_parts[0];
                        $condition = $field_parts[1];
                        $originalFields[$field] = $condition;
                        $searchFields[$index] = $field;
                    }
                }
            }

            foreach ($originalFields as $field => $condition) {
                if (is_numeric($field)) {
                    $field = $condition;
                    $condition = "=";
                }
                if (in_array($field, $searchFields)) {
                    $fields[$field] = $condition;
                }
            }

            if (count($fields) == 0) {
                throw new \Exception(trans('repository::criteria.fields_not_accepted', array('field' => implode(',', $searchFields))));
            }

        }

        return $fields;
    }

}