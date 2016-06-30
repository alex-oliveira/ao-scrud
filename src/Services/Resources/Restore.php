<?php

namespace AoScrud\Services\Resources;

use AoScrud\Services\Configs\RestoreConfig;

trait Restore
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

        $t = Transaction()->begin();
        try {
            $result = $this->restoreExecute();
        } catch (\Exception $e) {
            Transaction()->rollBack($t);
            throw $e;
        }
        Transaction()->commit($t);

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