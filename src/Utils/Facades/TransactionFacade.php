<?php

namespace AoScrud\Utils\Facades;

class TransactionFacade
{

    protected $active = false;

    public function begin()
    {
        if (!$this->active) {
            app('db')->beginTransaction();
            return $this->active = true;
        }
        return false;
    }

    public function rollBack($status)
    {
        if ($status && $this->active) {
            app('db')->rollBack();
            $this->active = false;
        }
    }

    public function commit($status)
    {
        if ($status && $this->active) {
            app('db')->commit();
            $this->active = false;
        }
    }

}
