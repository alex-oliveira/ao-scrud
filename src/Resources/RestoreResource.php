<?php

namespace AoScrud\Resources;

use AoScrud\Configs\RestoreConfig;

trait RestoreResource
{

    /**
     * Configs to restore.
     *
     * @var RestoreConfig
     */
    protected $restore;

    /**
     * Return the configs to restore.
     */
    public function restoreConfig()
    {
        return $this->restore;
    }

    //------------------------------------------------------------------------------------------------------------------
    // MAIN METHOD
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to restore.
     *
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function restore(array $data)
    {
        $this->restore->data($data);

        $this->restorePrepare();

        $t = AoScrud()->transaction()->begin();
        try {
            $this->restore->triggerOnExecute();
            $result = $this->restoreExecute();
            $this->restore->triggerOnExecuteEnd($result);
        } catch (\Exception $e) {
            AoScrud()->transaction()->rollBack($t);
            $this->restore->triggerOnExecuteError($e);
            throw $e;
        }
        AoScrud()->transaction()->commit($t);

        $this->restore->triggerOnSuccess($result);

        return $result;
    }

    //------------------------------------------------------------------------------------------------------------------
    // AUXILIARY METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Run all preparations before restore.
     */
    protected function restorePrepare()
    {
        $this->restore->triggerOnPrepare();
        try {
            $this->restoreSelect();
        } catch (\Exception $e) {
            $this->restore->triggerOnPrepareError($e);
            throw $e;
        }
        $this->restore->triggerOnPrepareEnd();
    }

    /**
     *  Select the object to restore.
     */
    protected function restoreSelect()
    {
        $this->restore->model($this->restore->model()->onlyTrashed());
        $obj = $this->restore->select();
        $obj ? $this->restore->obj($obj) : abort(404);
    }

    /**
     * Run restore command in the model.
     *
     * @return bool|null
     */
    protected function restoreExecute()
    {
        return $this->restore->obj()->restore();
    }

}