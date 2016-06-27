<?php

namespace AoScrud\Repositories\Interfaces\Methods;

use Illuminate\Support\Collection;

interface CascadeInterface
{

    /**
     * @param array|null $cascade
     * @return $this|Collection
     */
    public function cascade(array $cascade = null);

    /**
     * @return Collection
     */
    public function getCascade();

    /**
     * @param array $cascade
     * @return $this
     */
    public function setCascade(array $cascade);

}