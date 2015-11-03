<?php

namespace AoScrud\Repositories\Traits;

trait TransactionTrait
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
        $this->transaction ? db()->beginTransaction() : null;
    }

    public function tRollBack()
    {
        $this->transaction ? db()->rollBack() : null;
    }

    public function tCommit()
    {
        $this->transaction ? db()->commit() : null;
    }

}
