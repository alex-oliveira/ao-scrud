<?php

namespace AoScrud\Resources;

use AoScrud\Configs\ReadConfig;
use Illuminate\Database\Eloquent\Model;

trait ReadResource
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
     * @throws \Exception
     */
    public function read(array $data)
    {
        $this->read->data($data);

        $this->readPrepare();

        try {
            $this->read->triggerOnExecute();
            $result = $this->readExecute();
            $this->read->triggerOnExecuteEnd($result);
        } catch (\Exception $e) {
            $this->read->triggerOnExecuteError($e);
            throw $e;
        }

        $this->read->triggerOnSuccess($result);

        return $result;
    }

    //------------------------------------------------------------------------------------------------------------------
    // AUXILIARY METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Run all preparations before read.
     */
    protected function readPrepare()
    {
        $this->read->triggerOnPrepare();
        try {
            $this->read->runCriteria();
        } catch (\Exception $e) {
            $this->read->triggerOnPrepareError($e);
            throw $e;
        }
        $this->read->triggerOnPrepareEnd();
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