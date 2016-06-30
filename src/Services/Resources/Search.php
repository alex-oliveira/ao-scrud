<?php

namespace AoScrud\Services\Resources;

use AoScrud\Services\Configs\SearchConfig;
use Illuminate\Pagination\LengthAwarePaginator;

trait Search
{

    /**
     * @var SearchConfig
     */
    protected $search;

    //------------------------------------------------------------------------------------------------------------------
    // MAIN METHOD
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to read in the repository.
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
    // SECONDARY METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Run all preparations before search.
     */
    protected function searchPrepare()
    {
        $this->search->runCriteria();
    }

    /**
     * Run find command in the repository.
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