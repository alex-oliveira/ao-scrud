<?php

namespace AoScrud\Utils\Traits;

trait Transactions
{

    protected $transaction = true;

    public function tEnable()
    {
        $this->transaction = true;
    }

    public function tDisable()
    {
        $this->transaction = false;
    }

    public function tBegin()
    {
        $this->transaction ? app('db')->beginTransaction() : null;
    }

    public function tRollBack()
    {
        $this->transaction ? app('db')->rollBack() : null;
    }

    public function tCommit()
    {
        $this->transaction ? app('db')->commit() : null;
    }

}