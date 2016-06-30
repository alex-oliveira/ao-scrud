<?php

namespace AoScrud\Services\Resources;

use AoScrud\Services\Configs\ReadConfig;
use Illuminate\Database\Eloquent\Model;

trait Read
{

    /**
     * Configs to read.
     *
     * @var ReadConfig
     */
    protected $read;

    /**
     * Return the configs to read.
     */
    public function readConfig()
    {
        return $this->read;
    }

    //------------------------------------------------------------------------------------------------------------------
    // MAIN METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to read.
     *
     * @param array $data
     * @return mixed
     */
    public function read(array $data)
    {
        $this->read->data($data);
        $this->readPrepare();
        return $this->readExecute();
    }

    //------------------------------------------------------------------------------------------------------------------
    // AUXILIARY METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Run all preparations before read.
     */
    protected function readPrepare()
    {
        $this->read->runCriteria();
    }

    /**
     * Run find command in the repository.
     *
     * @return Model
     */
    protected function readExecute()
    {
        $obj = $this->read->select();
        $obj ? $this->read->obj($obj) : abort(404);
        return $obj;
    }

}