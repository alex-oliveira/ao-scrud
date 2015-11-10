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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Model[]
     */
    public function search($request)
    {
        # wheres
        $query = $this->model->where(function ($query) use ($request) {
            $this->searchWhere($query, $request);
        });

        # columns
        $columns = $this->searchSelect($request->get('columns', []));
        if (!empty($columns))
            $query->select($columns);

        # order
        if (!empty($this->searchOrders)) {
            $order = $request->get('order', false);
            if ($order && in_array($order, $this->searchOrders))
                $query->orderBy($order);
            else
                $query->orderBy($this->searchOrders[0]);
        }

        # customs
        $this->searchCustom($query, $request);

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
     * @param \Illuminate\Http\Request $request
     */
    protected function searchWhere($query, $request)
    {
        // TODO: overwrite in repository.
    }

    /**
     * Add research columns.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param \Illuminate\Http\Request $request
     */
    protected function searchCustom($query, $request)
    {
        // TODO: overwrite in repository.
    }

}
