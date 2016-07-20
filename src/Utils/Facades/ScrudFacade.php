<?php

namespace AoScrud\Utils\Facades;

use Illuminate\Support\Collection;

class ScrudFacade
{

    /**
     * @return Collection
     */
    public function params()
    {
        return collect(array_merge(request()->all(), request()->route()->parameters()));
    }

    /**
     * @return Collection
     */
    public function paramsSearch()
    {
        return $this->params()->only('search', 'columns', 'order', 'sort', 'limit');
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
