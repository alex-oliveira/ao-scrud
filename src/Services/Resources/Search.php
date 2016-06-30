<?php

namespace AoScrud\Services\Resources;

use AoScrud\Services\Configs\SearchConfig;
use Illuminate\Pagination\LengthAwarePaginator;

trait Search
{

    /**
     * Configs to search.
     *
     * @var SearchConfig
     */
    protected $search;

    /**
     * Return the configs to search.
     */
    public function searchConfig()
    {
        return $this->search;
    }

    //------------------------------------------------------------------------------------------------------------------
    // MAIN METHOD
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to read.
     *
     * @param array $data
     * @return mixed
     */
    public function search(array $data)
    {
        $this->search->data($data);
        $this->searchPrepare();
        return $this->searchExecute();
    }

    //------------------------------------------------------------------------------------------------------------------
    // AUXILIARY METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Run all preparations before search.
     */
    protected function searchPrepare()
    {
        $this->search->runCriteria();
    }

    /**
     * Run paginate command in the model.
     *
     * @return LengthAwarePaginator
     */
    protected function searchExecute()
    {
        return $this->search->total()
            ? $this->search->model()->paginate($this->search->limit())
            : $this->search->model()->paginate($this->search->limit());
    }

}