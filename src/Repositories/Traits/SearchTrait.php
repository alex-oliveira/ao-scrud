<?php

namespace AoScrud\Repositories\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

trait SearchTrait
{
    /**
     * Define the allowed research columns.
     *
     * @var array
     */
    protected $searchColumns = []; // TODO: overwrite in repository.

    /**
     * Define the allowed research columns.
     *
     * @var array
     */
    protected $searchOrders = []; // TODO: overwrite in repository.

    /**
     * Define the quantity of records per page.
     *
     * @var array
     */
    protected $searchItemsPerPage = 24; // TODO: overwrite in repository.

    /**
     * Research method and paging.
     *
     * @param  array $data
     * @return Model[]
     */
    public function search(array $data = [])
    {
        # wheres
        $query = $this->model()->where(function ($query) use ($data) {
            $this->searchWhere($query, $data);
        });

        # columns
        $columns = $this->searchSelect(empty($data['columns']) ? [] : $data['columns']);
        if (!empty($columns)) {
            $query->select($columns);
        }

        # order
        if (isset($data['order']) && in_array($data['order'], $this->searchOrders)) {
            $query->orderBy($data['order']);
        }

        # customs
        $this->searchCustom($query, $data);

        # pagination
        return $query->paginate($this->searchItemsPerPage);
    }

    /**
     * Define the research columns.
     *
     * @param array $columns
     * @return array
     */
    protected function searchSelect(array $columns)
    {
        if (empty($this->searchColumns)) {
            return [];
        } else {
            if (empty($columns)) {
                return $this->searchColumns;
            } else {
                return collect($this->searchColumns)->intersect($columns)->all();
            }
        }
    }

    /**
     * Add research rules.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param \array $data
     */
    protected function searchWhere(&$query, &$data)
    {
        // TODO: overwrite in repository.
    }

    /**
     * Add research columns.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param \array $data
     */
    protected function searchCustom(&$query, &$data)
    {
        // TODO: overwrite in repository.
    }

}
