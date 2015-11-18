<?php

namespace AoScrud\Repositories\Traits;

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
     * @return \Illuminate\Database\Eloquent\Model[]
     */
    public function search(array $data)
    {
        $data = collect($data);

        # wheres
        $query = $this->model()->where(function ($query) use ($data) {
            $this->searchWhere($query, $data);
        });

        # columns
        $columns = $this->searchSelect($data->get('columns', []));
        if (!empty($columns))
            $query->select($columns);

        # order
        if (!empty($this->searchOrders)) {
            $order = $data->get('order', false);
            if ($order && in_array($order, $this->searchOrders))
                $query->orderBy($order);
            else
                $query->orderBy($this->searchOrders[0]);
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
        if (empty($this->searchColumns))
            return [];
        elseif (empty($columns))
            return $this->searchColumns;
        else
            return collect($this->searchColumns)->intersect($columns)->all();
    }

    /**
     * Add research rules.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Support\Collection $data
     */
    protected function searchWhere($query, $data)
    {
        // TODO: overwrite in repository.
    }

    /**
     * Add research columns.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Support\Collection $data
     */
    protected function searchCustom($query, $data)
    {
        // TODO: overwrite in repository.
    }

}
