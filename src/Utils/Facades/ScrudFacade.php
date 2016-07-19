<?php

namespace AoScrud\Utils\Facades;

class ScrudFacade
{

    /**
     * @return array
     */
    public function params()
    {
        return array_merge(request()->all(), request()->route()->parameters());
    }

    /**
     * @return ValidateFacade
     */
    public function validate()
    {
        return new ValidateFacade();
    }

    /**
     * @return TransactionFacade
     */
    public function transaction()
    {
        return new TransactionFacade();
    }

}
