<?php

namespace AoScrud\Repositories\Traits;

use DB;

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
        $this->transaction ? DB::beginTransaction() : null;
    }

    public function tRollBack()
    {
        $this->transaction ? DB::rollBack() : null;
    }

    public function tCommit()
    {
        $this->transaction ? DB::commit() : null;
    }

}
