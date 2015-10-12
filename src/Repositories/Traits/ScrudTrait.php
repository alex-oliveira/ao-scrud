<?php

namespace AoScrud\Repositories\Traits;

trait ScrudTrait
{

    /**
     * Traits of the Scrud.
     */
    use BaseTrait,
        SearchTrait,
        CreateTrait,
        ReadTrait,
        UpdateTrait,
        DestroyTrait,
        TransactionTrait;

}
