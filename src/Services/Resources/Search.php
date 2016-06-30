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
     * @throws \Exception
     */
    public function search(array $data)
    {
        $this->search->data($data);

        $this->searchPrepare();

        try {
            $this->search->triggerOnExecute();
            $result = $this->searchExecute();
            $this->search->triggerOnExecuteEnd($result);
        } catch (\Exception $e) {
            $this->search->triggerOnExecuteError($e);
            throw $e;
        }

        $this->search->triggerOnSuccess($result);

        return $result;
    }

    //------------------------------------------------------------------------------------------------------------------
    // AUXILIARY METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Run all preparations before search.
     */
    protected function searchPrepare()
    {
        $this->search->triggerOnPrepare();
        try {
            $this->search->runCriteria();
        } catch (\Exception $e) {
            $this->search->triggerOnPrepareError($e);
            throw $e;
        }
        $this->search->triggerOnPrepareEnd();
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