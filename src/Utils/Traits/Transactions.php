<?php

namespace AoScrud\Utils\Traits;

trait Transactions
{

    protected $transaction = false;

    public function tEnable()
    {
        $this->transaction = true;
        return $this;
    }

    public function tDisable()
    {
        $this->transaction = false;
        return $this;
    }

    public function tBegin()
    {
        $this->transaction ? app('db')->beginTransaction() : null;
        return $this;
    }

    public function tRollBack()
    {
        $this->transaction ? app('db')->rollBack() : null;
        return $this;
    }

    public function tCommit()
    {
        $this->transaction ? app('db')->commit() : null;
        return $this;
    }

}
