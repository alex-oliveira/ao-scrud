<?php

namespace AoScrud\Repositories\Interfaces\Methods;

use Illuminate\Support\Collection;

interface DissociateInterface
{

    /**
     * @param array|null $dissociate
     * @return $this|Collection
     */
    public function dissociate(array $dissociate = null);

    /**
     * @return Collection
     */
    public function getDissociate();

    /**
     * @param array $dissociate
     * @return $this
     */
    public function setDissociate(array $dissociate);

}